<?php
namespace App\Http\Controllers;

use App\Http\Traits\LogsActivity;
use App\Models\Pejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Enums\JabatanEnum;
use Illuminate\Validation\Rule;

class PejabatController extends Controller
{
    use LogsActivity;
    public function index() {
        $pejabats = Pejabat::orderBy('order')->get();
        return view('admin.pejabat.index', compact('pejabats'));
    }

    public function create() {
        return view('admin.pejabat.create', [
        'jabatans' => JabatanEnum::cases()
    ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'jabatan' => ['required', Rule::enum(JabatanEnum::class)],
            'photo' => 'nullable|image|max:2048',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('pejabat', 'public');
        }
        $pejabat = Pejabat::create($data);
        $this->logCreate($pejabat, "Menambahkan pejabat: {$pejabat->name} - {$pejabat->jabatan->value}");
        
        return redirect()->route('pejabat.index')->with('success', 'Pejabat berhasil ditambahkan!');
    }

    public function edit(Pejabat $pejabat) {
        return view('admin.pejabat.edit', [
        'pejabat' => $pejabat,
        'jabatans' => JabatanEnum::cases()
    ]);
    }

    public function update(Request $request, Pejabat $pejabat) {
        $oldValues = $pejabat->toArray();
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'jabatan' => ['required', Rule::enum(JabatanEnum::class)],
            'photo' => 'nullable|image|max:2048',
            'order' => 'required|integer',
        ]);

        if ($request->hasFile('photo')) {
            if ($pejabat->photo) {
                Storage::disk('public')->delete($pejabat->photo);
            }
            $data['photo'] = $request->file('photo')->store('pejabat', 'public');
        }

        $pejabat->update($data);
        $this->logUpdate($pejabat, $oldValues, "Mengubah data pejabat: {$pejabat->name}");
        
        return redirect()->route('pejabat.index')->with('success', 'Pejabat berhasil diperbarui!');
    }

    public function destroy(Pejabat $pejabat) {
        $name = $pejabat->name;
        $jabatan = $pejabat->jabatan->value;
        
        if ($pejabat->photo) {
            Storage::disk('public')->delete($pejabat->photo);
        }
        
        $this->logDelete($pejabat, "Menghapus data pejabat: {$name} - {$jabatan}");
        $pejabat->delete();
        
        return redirect()->route('pejabat.index')->with('success', 'Pejabat berhasil dihapus!');
    }
}