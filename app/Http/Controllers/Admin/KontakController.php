<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogsActivity;
use Illuminate\Http\Request;
use App\Models\Kontak;

class KontakController extends Controller
{
    use LogsActivity;
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $pesans = Kontak::latest()->get();
        return view('admin.kontak.index', compact('pesans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kontak $kontak) {
        return view('admin.kontak.show', compact('kontak'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kontak $kontak) {
        $nama = $kontak->nama;
        $email = $kontak->email;
        
        $this->logDelete($kontak, "Menghapus pesan kontak dari: {$nama} ({$email})");
        $kontak->delete();
        
        return redirect()->route('kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
