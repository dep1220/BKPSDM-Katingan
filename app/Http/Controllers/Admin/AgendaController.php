<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogsActivity;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AgendaController extends Controller
{
    use LogsActivity;
    /**
     * Display a listing of agenda.
     */
    public function index(Request $request)
    {
        $query = Agenda::query();
        
        // Tampilkan semua agenda tanpa filter kata kunci

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by month
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->whereYear('created_at', $request->year);
        }

        $agenda = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get available years for filter
        $years = Agenda::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('admin.agenda.index', compact('agenda', 'years', 'months'));
    }

    /**
     * Show the form for creating a new agenda.
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Store a newly created agenda in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240', // 10MB max
        ], [
            'title.required' => 'Judul agenda wajib diisi.',
            'title.max' => 'Judul agenda maksimal 255 karakter.',
            'description.required' => 'Deskripsi kegiatan wajib diisi.',
            'description.min' => 'Deskripsi kegiatan minimal 10 karakter.',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, XLS, XLSX, PPT, atau PPTX.',
            'file.max' => 'Ukuran file maksimal 10MB.',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('agenda', $filename, 'public');
            $data['file_path'] = $path;
        }

        $agenda = Agenda::create($data);

        // Log activity
        $this->logCreate($agenda, "Menambahkan agenda baru: {$agenda->title}");

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan.');
    }

    /**
     * Display the specified agenda.
     */
    public function show(Agenda $agenda)
    {
        return view('admin.agenda.show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified agenda.
     */
    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified agenda in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        // Simpan nilai lama untuk logging
        $oldValues = $agenda->toArray();
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240', // 10MB max
        ], [
            'title.required' => 'Judul agenda wajib diisi.',
            'title.max' => 'Judul agenda maksimal 255 karakter.',
            'description.required' => 'Deskripsi kegiatan wajib diisi.',
            'description.min' => 'Deskripsi kegiatan minimal 10 karakter.',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, XLS, XLSX, PPT, atau PPTX.',
            'file.max' => 'Ukuran file maksimal 10MB.',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($agenda->file_path && Storage::disk('public')->exists($agenda->file_path)) {
                Storage::disk('public')->delete($agenda->file_path);
            }

            $file = $request->file('file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('agenda', $filename, 'public');
            $data['file_path'] = $path;
        }

        $agenda->update($data);

        // Log activity dengan perubahan
        $this->logUpdate($agenda, $oldValues, "Mengubah agenda: {$agenda->title}");

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    /**
     * Remove the specified agenda from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $title = $agenda->title;
        
        // Delete file if exists
        if ($agenda->file_path && Storage::disk('public')->exists($agenda->file_path)) {
            Storage::disk('public')->delete($agenda->file_path);
        }

        // Log activity sebelum menghapus
        $this->logDelete($agenda, "Menghapus agenda: {$title}");
        
        $agenda->delete();

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }

    /**
     * Download agenda file.
     */
    public function download(Agenda $agenda)
    {
        if (!$agenda->file_path || !Storage::disk('public')->exists($agenda->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $filePath = storage_path('app/public/' . $agenda->file_path);
        $fileName = $agenda->title . '.' . pathinfo($agenda->file_path, PATHINFO_EXTENSION);

        return response()->download($filePath, $fileName);
    }
}
