<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogsActivity;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Enums\AgendaStatus;

class AgendaController extends Controller
{
    use LogsActivity;
    /**
     * Display a listing of agenda.
     */
    public function index(Request $request)
    {
        // Update status agenda berdasarkan waktu
        Agenda::batchUpdateStatus();

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

    public function store(Request $request)
    {
        // 1. Validasi (Kode validasi Anda sudah bagus!)
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'status' => 'required|in:' . implode(',', array_column(AgendaStatus::cases(), 'value')),
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120', // 5MB max
        ], [
            'title.required' => 'Judul agenda wajib diisi.',
            'title.max' => 'Judul agenda maksimal 255 karakter.',
            'description.required' => 'Deskripsi kegiatan wajib diisi.',
            'description.min' => 'Deskripsi kegiatan minimal 10 karakter.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_date.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            'start_time.date_format' => 'Format jam mulai tidak valid (HH:MM).',
            'end_time.date_format' => 'Format jam selesai tidak valid (HH:MM).',
            'end_time.after' => 'Jam selesai harus lebih besar dari jam mulai.',
            'status.required' => 'Status agenda wajib dipilih.',
            'status.in' => 'Status agenda tidak valid.',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, XLS, XLSX, PPT, atau PPTX.',
            'file.max' => 'Ukuran file maksimal 5MB.',
        ]);

        // 2. Tentukan status otomatis menggunakan helper function
        $status = $this->determineStatus(
            $request->start_date,
            $request->end_date,
            $request->start_time,
            $request->end_time
        );

        // 3. Beri pengecualian jika user memilih "Dibatalkan" secara manual
        if ($request->status === AgendaStatus::CANCELLED->value) {
            $status = AgendaStatus::CANCELLED;
        }

        // 4. Siapkan data dan simpan ke database
        $agenda = new Agenda();
        $agenda->title = $request->title;
        $agenda->description = $request->description;
        $agenda->start_date = $request->start_date;
        $agenda->end_date = $request->end_date;
        $agenda->start_time = $request->start_time;
        $agenda->end_time = $request->end_time;
        $agenda->status = $status; // <-- Menggunakan status yang sudah dihitung otomatis

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('agenda', $filename, 'public');
            $agenda->file_path = $path;
        }

        $agenda->save();

        $this->logCreate($agenda, "Menambahkan agenda baru: {$agenda->title}");

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan dengan status otomatis.');
    }

    private function determineStatus($startDate, $endDate, $startTime, $endTime): AgendaStatus
    {
        $now = Carbon::now();

        // Gabungkan tanggal dan waktu untuk perbandingan yang akurat
        $startDateTime = Carbon::parse($startDate . ' ' . ($startTime ?? '00:00:00'));

        // Jika tidak ada tanggal selesai, pakai tanggal mulai.
        // Jika tidak ada waktu selesai, anggap selesai di akhir hari.
        $endDateTime = Carbon::parse(($endDate ?? $startDate) . ' ' . ($endTime ?? '23:59:59'));

        if ($now->lt($startDateTime)) {
            // Waktu sekarang < Waktu Mulai -> Akan Datang
            return AgendaStatus::UPCOMING;
        } elseif ($now->between($startDateTime, $endDateTime)) {
            // Waktu Mulai <= Waktu Sekarang <= Waktu Selesai -> Sedang Berlangsung
            return AgendaStatus::ONGOING;
        } else {
            // Waktu Sekarang > Waktu Selesai -> Selesai
            return AgendaStatus::COMPLETED;
        }
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
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120', // 5MB max
        ], [
            'title.required' => 'Judul agenda wajib diisi.',
            'title.max' => 'Judul agenda maksimal 255 karakter.',
            'description.required' => 'Deskripsi kegiatan wajib diisi.',
            'description.min' => 'Deskripsi kegiatan minimal 10 karakter.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_date.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            'start_time.date_format' => 'Format jam mulai tidak valid (HH:MM).',
            'end_time.date_format' => 'Format jam selesai tidak valid (HH:MM).',
            'end_time.after' => 'Jam selesai harus lebih besar dari jam mulai.',
            'status.required' => 'Status agenda wajib dipilih.',
            'status.in' => 'Status agenda tidak valid.',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, XLS, XLSX, PPT, atau PPTX.',
            'file.max' => 'Ukuran file maksimal 5MB.',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
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
