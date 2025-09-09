<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogsActivity;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    use LogsActivity;

    /**
     * Display a listing of visi misi.
     */
    public function index()
    {
        $visiMisi = VisiMisi::latest()->paginate(10);
        return view('admin.visi-misi.index', compact('visiMisi'));
    }

    /**
     * Show the form for creating new visi misi.
     */
    public function create()
    {
        return view('admin.visi-misi.create');
    }

    /**
     * Store a newly created visi misi in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string|min:20',
            'misi' => 'required|array|min:1',
            'misi.*' => 'required|string|min:10',
        ], [
            'visi.required' => 'Visi wajib diisi.',
            'visi.min' => 'Visi minimal 20 karakter.',
            'misi.required' => 'Misi wajib diisi.',
            'misi.min' => 'Minimal harus ada 1 misi.',
            'misi.*.required' => 'Setiap misi wajib diisi.',
            'misi.*.min' => 'Setiap misi minimal 10 karakter.',
        ]);

        // Set semua visi misi lain menjadi tidak aktif
        VisiMisi::query()->update(['is_active' => false]);

        // Bersihkan array misi dari nilai kosong
        $misi = array_filter($request->misi, function($item) {
            return !empty(trim($item));
        });

        $visiMisi = VisiMisi::create([
            'visi' => $request->visi,
            'misi' => array_values($misi), // Reset index array
            'is_active' => true,
        ]);

        // Log activity
        $this->logCreate($visiMisi, "Menambahkan visi misi baru");

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil ditambahkan dan diaktifkan.');
    }

    /**
     * Display the specified visi misi.
     */
    public function show(VisiMisi $visiMisi)
    {
        return view('admin.visi-misi.show', compact('visiMisi'));
    }

    /**
     * Show the form for editing the specified visi misi.
     */
    public function edit(VisiMisi $visiMisi)
    {
        return view('admin.visi-misi.edit', compact('visiMisi'));
    }

    /**
     * Update the specified visi misi in storage.
     */
    public function update(Request $request, VisiMisi $visiMisi)
    {
        $oldValues = $visiMisi->toArray();

        $request->validate([
            'visi' => 'required|string|min:20',
            'misi' => 'required|array|min:1',
            'misi.*' => 'required|string|min:10',
        ], [
            'visi.required' => 'Visi wajib diisi.',
            'visi.min' => 'Visi minimal 20 karakter.',
            'misi.required' => 'Misi wajib diisi.',
            'misi.min' => 'Minimal harus ada 1 misi.',
            'misi.*.required' => 'Setiap misi wajib diisi.',
            'misi.*.min' => 'Setiap misi minimal 10 karakter.',
        ]);

        // Bersihkan array misi dari nilai kosong
        $misi = array_filter($request->misi, function($item) {
            return !empty(trim($item));
        });

        $visiMisi->update([
            'visi' => $request->visi,
            'misi' => array_values($misi), // Reset index array
        ]);

        // Log activity
        $this->logUpdate($visiMisi, $oldValues, "Mengubah visi misi");

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil diperbarui.');
    }

    /**
     * Remove the specified visi misi from storage.
     */
    public function destroy(VisiMisi $visiMisi)
    {
        // Log activity sebelum menghapus
        $this->logDelete($visiMisi, "Menghapus visi misi");
        
        $visiMisi->delete();

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil dihapus.');
    }

    /**
     * Activate specific visi misi
     */
    public function activate(VisiMisi $visiMisi)
    {
        // Set semua visi misi lain menjadi tidak aktif
        VisiMisi::query()->update(['is_active' => false]);
        
        // Aktifkan visi misi yang dipilih
        $visiMisi->update(['is_active' => true]);

        // Log activity
        $this->logUpdate($visiMisi, ['is_active' => false], "Mengaktifkan visi misi");

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil diaktifkan.');
    }

    /**
     * Deactivate specific visi misi
     */
    public function deactivate(VisiMisi $visiMisi)
    {
        // Nonaktifkan visi misi yang dipilih
        $visiMisi->update(['is_active' => false]);

        // Log activity
        $this->logUpdate($visiMisi, ['is_active' => true], "Menonaktifkan visi misi");

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Visi dan Misi berhasil dinonaktifkan.');
    }
}
