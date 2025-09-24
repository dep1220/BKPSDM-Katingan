<?php

namespace App\Http\Controllers;

use App\Http\Traits\LogsActivity;
use App\Models\Unduhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnduhanController extends Controller
{
    use LogsActivity;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unduhans = Unduhan::latest()->get();
        return view('admin.unduhan.index', compact('unduhans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.unduhan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:5120', // Hanya dokumen, Max 5MB
        ]);

        // Simpan file dan get path
        $filePath = $request->file('file')->store('unduhan', 'public');

        // Hapus 'file' dari validated data dan tambahkan 'file_path'
        unset($validated['file']);
        $validated['file_path'] = $filePath;

        $unduhan = Unduhan::create($validated);
        $this->logCreate($unduhan, "Menambahkan file unduhan: {$unduhan->title}");

        return redirect()->route('unduhan.index')->with('success', 'File berhasil diunggah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unduhan $unduhan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unduhan $unduhan)
    {
        return view('admin.unduhan.edit', compact('unduhan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unduhan $unduhan)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:5120', // 'file' dibuat nullable
        ]);

        // 2. Cek apakah ada file baru yang diunggah
        if ($request->hasFile('file')) {
            // Hapus file lama untuk menghemat ruang penyimpanan
            if ($unduhan->file_path) {
                Storage::disk('public')->delete($unduhan->file_path);
            }

            // Simpan file baru
            $filePath = $request->file('file')->store('unduhan', 'public');
            $originalFilename = $request->file('file')->getClientOriginalName();

            // Update path dan nama file di database
            $unduhan->file_path = $filePath;
//            $unduhan->original_filename = $originalFilename;
        }

        // 3. Update data lainnya (judul dan deskripsi)
        $unduhan->title = $validatedData['title'];
        $unduhan->description = $validatedData['description'];

        $unduhan->save();


        return redirect()->route('unduhan.index')->with('success', 'File unduhan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unduhan $unduhan)
    {
        $title = $unduhan->title;

        // Hapus file dari storage jika ada
        if ($unduhan->file_path && Storage::disk('public')->exists($unduhan->file_path)) {
            Storage::disk('public')->delete($unduhan->file_path);
        }

        $this->logDelete($unduhan, "Menghapus file unduhan: {$title}");
        // Hapus record dari database
        $unduhan->delete();

        return redirect()->route('unduhan.index')->with('success', 'File berhasil dihapus!');
    }
}
