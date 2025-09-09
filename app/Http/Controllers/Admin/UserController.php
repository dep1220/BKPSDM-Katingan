<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogsActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $users = User::with('roles')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name');
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array'
        ]);

        $validated['password'] = Hash::make($request->password);
        $user = User::create($validated);
        $user->syncRoles($request->roles);

        // Log activity
        $this->logCreate($user, "Menambahkan user baru: {$user->name} ({$user->email})");

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dibuat.');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // Simpan nilai lama untuk logging
        $oldValues = $user->toArray();
        $oldRoles = $user->roles->pluck('name')->toArray();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }
        
        $user->update($validated);
        $user->syncRoles($request->roles);

        // Log activity dengan detail perubahan
        $changes = [];
        if ($oldValues['name'] !== $user->name) $changes[] = "nama";
        if ($oldValues['email'] !== $user->email) $changes[] = "email";
        if ($request->filled('password')) $changes[] = "password";
        if ($oldRoles !== $request->roles) $changes[] = "role";
        
        $changeText = empty($changes) ? "data" : implode(", ", $changes);
        $this->logUpdate($user, $oldValues, "Mengubah {$changeText} user: {$user->name}");

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->id == $user->id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $userName = $user->name;
        $this->logDelete($user, "Menghapus user: {$userName} ({$user->email})");
        $user->delete();
        
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}