<?php

namespace App\Http\Controllers\Api;

use App\Enums\AgendaStatus;
use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaApiController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/agendas",
     * operationId="getAgendaList",
     * tags={"Agenda"},
     * summary="Menampilkan daftar semua agenda kegiatan",
     * description="Mengambil daftar agenda yang sudah dipaginasi. Mendukung pencarian dan filter berdasarkan bulan dan tahun.",
     * @OA\Parameter(name="search", in="query", description="Pencarian berdasarkan judul atau deskripsi", @OA\Schema(type="string")),
     * @OA\Parameter(name="month", in="query", description="Filter berdasarkan bulan (1-12)", @OA\Schema(type="integer", minimum=1, maximum=12)),
     * @OA\Parameter(name="year", in="query", description="Filter berdasarkan tahun", @OA\Schema(type="integer")),
     * @OA\Parameter(name="limit", in="query", description="Jumlah data per halaman (default: 10)", @OA\Schema(type="integer", minimum=1, maximum=100)),
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="current_page", type="integer", example=1),
     * @OA\Property(
     * property="data",
     * type="array",
     * @OA\Items(
     * type="object",
     * @OA\Property(property="id", type="integer", readOnly=true, example=1),
     * @OA\Property(property="title", type="string", example="Rapat Koordinasi Bulanan"),
     * @OA\Property(property="slug", type="string", readOnly=true, example="rapat-koordinasi-bulanan"),
     * @OA\Property(property="description", type="string", example="Rapat untuk membahas evaluasi kinerja."),
     * @OA\Property(property="start_date", type="string", format="date", example="2025-09-24"),
     * @OA\Property(property="end_date", type="string", format="date", nullable=true, example="2025-09-25"),
     * @OA\Property(property="start_time", type="string", format="time", nullable=true, example="09:00:00"),
     * @OA\Property(property="end_time", type="string", format="time", nullable=true, example="11:00:00"),
     * @OA\Property(property="status", type="string", enum={"upcoming", "ongoing", "completed", "cancelled"}, example="ongoing"),
     * @OA\Property(property="file_path", type="string", nullable=true, readOnly=true),
     * @OA\Property(property="file_url", type="string", nullable=true, readOnly=true),
     * @OA\Property(property="created_at", type="string", format="date-time", readOnly=true),
     * @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true)
     * )
     * ),
     * @OA\Property(property="first_page_url", type="string"),
     * @OA\Property(property="from", type="integer"),
     * @OA\Property(property="last_page", type="integer"),
     * @OA\Property(property="last_page_url", type="string"),
     * @OA\Property(property="next_page_url", type="string", nullable=true),
     * @OA\Property(property="path", type="string"),
     * @OA\Property(property="per_page", type="integer"),
     * @OA\Property(property="prev_page_url", type="string", nullable=true),
     * @OA\Property(property="to", type="integer"),
     * @OA\Property(property="total", type="integer")
     * )
     * )
     * )
     */
    public function index(Request $request)
    {
        Agenda::batchUpdateStatus();
        $query = Agenda::query();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('month')) {
            $query->whereMonth('start_date', $request->month);
        }

        if ($request->filled('year')) {
            $query->whereYear('start_date', $request->year);
        }

        $limit = $request->get('limit', 10);
        $limit = min(max($limit, 1), 100);

        $agendas = $query->orderBy('start_date', 'desc')->paginate($limit);

        return response()->json($agendas);
    }

    /**
     * @OA\Get(
     * path="/api/agendas/{slug}",
     * operationId="getAgendaBySlug",
     * tags={"Agenda"},
     * summary="Menampilkan detail satu agenda",
     * @OA\Parameter(name="slug", in="path", required=true, @OA\Schema(type="string"), example="contoh-agenda-unik"),
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="id", type="integer", readOnly=true, example=1),
     * @OA\Property(property="title", type="string", example="Rapat Koordinasi Bulanan"),
     * @OA\Property(property="slug", type="string", readOnly=true, example="rapat-koordinasi-bulanan"),
     * @OA\Property(property="description", type="string", example="Rapat untuk membahas evaluasi kinerja."),
     * @OA\Property(property="start_date", type="string", format="date", example="2025-09-24"),
     * @OA\Property(property="end_date", type="string", format="date", nullable=true, example="2025-09-25"),
     * @OA\Property(property="start_time", type="string", format="time", nullable=true, example="09:00:00"),
     * @OA\Property(property="end_time", type="string", format="time", nullable=true, example="11:00:00"),
     * @OA\Property(property="status", type="string", enum={"upcoming", "ongoing", "completed", "cancelled"}, example="ongoing"),
     * @OA\Property(property="file_path", type="string", nullable=true, readOnly=true),
     * @OA\Property(property="file_url", type="string", nullable=true, readOnly=true),
     * @OA\Property(property="created_at", type="string", format="date-time", readOnly=true),
     * @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true)
     * )
     * ),
     * @OA\Response(response=404, description="Data tidak ditemukan", @OA\JsonContent(@OA\Property(property="message", type="string", example="Data tidak ditemukan.")))
     * )
     */
    public function show(Agenda $agenda)
    {
        return response()->json($agenda);
    }

    /**
     * @OA\Post(
     * path="/api/agendas",
     * operationId="storeAgenda",
     * tags={"Agenda"},
     * summary="Membuat agenda baru (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"title", "description", "start_date"},
     * @OA\Property(property="title", type="string", maxLength=255, example="Rapat Koordinasi Awal Tahun"),
     * @OA\Property(property="description", type="string", minLength=10, example="Pembahasan rencana kerja tahunan."),
     * @OA\Property(property="start_date", type="string", format="date", description="Tanggal mulai agenda (Wajib)", example="2025-10-28"),
     * @OA\Property(property="end_date", type="string", format="date", description="Tanggal selesai agenda (Opsional)", example="2025-10-29"),
     * @OA\Property(property="start_time", type="string", format="time", description="Waktu mulai (Opsional, format HH:MM)", example="09:00"),
     * @OA\Property(property="end_time", type="string", format="time", description="Waktu selesai (Opsional, format HH:MM)", example="11:00"),
     * @OA\Property(property="status", type="string", enum={"cancelled"}, description="Hanya diisi 'cancelled' jika ingin membatalkan agenda secara manual."),
     * @OA\Property(property="file", type="string", format="binary", description="File lampiran (opsional, maks 5MB)")
     * )
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Agenda berhasil dibuat",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="id", type="integer", readOnly=true, example=1),
     * @OA\Property(property="title", type="string", example="Rapat Koordinasi Bulanan"),
     * @OA\Property(property="slug", type="string", readOnly=true, example="rapat-koordinasi-bulanan"),
     * @OA\Property(property="description", type="string", example="Rapat untuk membahas evaluasi kinerja."),
     * @OA\Property(property="start_date", type="string", format="date", example="2025-09-24"),
     * @OA\Property(property="end_date", type="string", format="date", nullable=true, example="2025-09-25"),
     * @OA\Property(property="start_time", type="string", format="time", nullable=true, example="09:00:00"),
     * @OA\Property(property="end_time", type="string", format="time", nullable=true, example="11:00:00"),
     * @OA\Property(property="status", type="string", enum={"upcoming", "ongoing", "completed", "cancelled"}, example="ongoing"),
     * @OA\Property(property="file_path", type="string", nullable=true, readOnly=true),
     * @OA\Property(property="file_url", type="string", nullable=true, readOnly=true),
     * @OA\Property(property="created_at", type="string", format="date-time", readOnly=true),
     * @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true)
     * )
     * ),
     * @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthenticated."))),
     * @OA\Response(
     * response=422,
     * description="Validation Error",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="message", type="string", example="The given data was invalid."),
     * @OA\Property(property="errors", type="object", example={"title": {"Judul agenda wajib diisi."}})
     * )
     * )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'status' => 'nullable|in:cancelled',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
        ]);

        $status = $this->determineStatus(
            $request->start_date,
            $request->end_date,
            $request->start_time,
            $request->end_time
        );

        if ($request->status === AgendaStatus::CANCELLED->value) {
            $status = AgendaStatus::CANCELLED;
        }

        $validatedData['status'] = $status;

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('agenda', 'public');
            $validatedData['file_path'] = $path;
        }
        unset($validatedData['file']);

        $agenda = Agenda::create($validatedData);

        return response()->json($agenda, 201);
    }

    /**
     * @OA\Post(
     * path="/api/agendas/{slug}",
     * operationId="updateAgenda",
     * tags={"Agenda"},
     * summary="Memperbarui agenda (gunakan metode POST dengan _method=PUT)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="slug", in="path", required=true, @OA\Schema(type="string"), example="contoh-agenda-unik"),
     * @OA\RequestBody(
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"_method"},
     * @OA\Property(property="_method", type="string", enum={"PUT"}, example="PUT", description="Wajib diisi 'PUT' untuk update"),
     * @OA\Property(property="title", type="string", maxLength=255, example="Judul Rapat Diperbarui"),
     * @OA\Property(property="description", type="string", minLength=10, example="Deskripsi diperbarui."),
     * @OA\Property(property="start_date", type="string", format="date", example="2025-11-01"),
     * @OA\Property(property="end_date", type="string", format="date", example="2025-11-01"),
     * @OA\Property(property="start_time", type="string", format="time", example="10:00"),
     * @OA\Property(property="end_time", type="string", format="time", example="12:00"),
     * @OA\Property(property="status", type="string", enum={"upcoming", "ongoing", "completed", "cancelled"}, example="upcoming"),
     * @OA\Property(property="file", type="string", format="binary", description="File baru untuk menggantikan yang lama (opsional)")
     * )
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Agenda berhasil diperbarui",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="id", type="integer", readOnly=true, example=1),
     * @OA\Property(property="title", type="string", example="Rapat Koordinasi Bulanan"),
     * @OA\Property(property="slug", type="string", readOnly=true, example="rapat-koordinasi-bulanan"),
     * @OA\Property(property="description", type="string", example="Rapat untuk membahas evaluasi kinerja."),
     * @OA\Property(property="start_date", type="string", format="date", example="2025-09-24"),
     * @OA\Property(property="end_date", type="string", format="date", nullable=true, example="2025-09-25"),
     * @OA\Property(property="start_time", type="string", format="time", nullable=true, example="09:00:00"),
     * @OA\Property(property="end_time", type="string", format="time", nullable=true, example="11:00:00"),
     * @OA\Property(property="status", type="string", enum={"upcoming", "ongoing", "completed", "cancelled"}, example="ongoing"),
     * @OA\Property(property="file_path", type="string", nullable=true, readOnly=true),
     * @OA\Property(property="file_url", type="string", nullable=true, readOnly=true),
     * @OA\Property(property="created_at", type="string", format="date-time", readOnly=true),
     * @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true)
     * )
     * ),
     * @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthenticated."))),
     * @OA\Response(response=404, description="Data tidak ditemukan", @OA\JsonContent(@OA\Property(property="message", type="string", example="Data tidak ditemukan."))),
     * @OA\Response(
     * response=422,
     * description="Validation Error",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="message", type="string", example="The given data was invalid."),
     * @OA\Property(property="errors", type="object", example={"title": {"Judul agenda wajib diisi."}})
     * )
     * )
     * )
     */
    public function update(Request $request, Agenda $agenda)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|min:10',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'status' => 'sometimes|required|in:' . implode(',', array_column(AgendaStatus::cases(), 'value')),
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
        ]);

        if ($request->hasFile('file')) {
            if ($agenda->file_path && Storage::disk('public')->exists($agenda->file_path)) {
                Storage::disk('public')->delete($agenda->file_path);
            }
            $path = $request->file('file')->store('agenda', 'public');
            $validatedData['file_path'] = $path;
        }
        unset($validatedData['file']);

        $agenda->update($validatedData);
        $agenda->refresh();

        return response()->json($agenda);
    }

    /**
     * @OA\Delete(
     * path="/api/agendas/{slug}",
     * operationId="deleteAgenda",
     * tags={"Agenda"},
     * summary="Menghapus agenda (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="slug", in="path", required=true, @OA\Schema(type="string"), example="contoh-agenda-unik"),
     * @OA\Response(response=204, description="Agenda berhasil dihapus"),
     * @OA\Response(response=401, description="Unauthenticated", @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthenticated."))),
     * @OA\Response(response=404, description="Data tidak ditemukan", @OA\JsonContent(@OA\Property(property="message", type="string", example="Data tidak ditemukan.")))
     * )
     */
    public function destroy(Agenda $agenda)
    {
        if ($agenda->file_path && Storage::disk('public')->exists($agenda->file_path)) {
            Storage::disk('public')->delete($agenda->file_path);
        }

        $agenda->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     * path="/api/agendas/{slug}/download",
     * operationId="downloadAgendaFile",
     * tags={"Agenda"},
     * summary="Mengunduh file agenda",
     * @OA\Parameter(name="slug", in="path", required=true, @OA\Schema(type="string"), example="contoh-agenda-unik"),
     * @OA\Response(response=200, description="File berhasil diunduh", @OA\MediaType(mediaType="application/octet-stream")),
     * @OA\Response(response=404, description="Data atau file tidak ditemukan", @OA\JsonContent(@OA\Property(property="message", type="string", example="File tidak ditemukan.")))
     * )
     */
    public function download(Agenda $agenda)
    {
        if (!$agenda->file_path || !Storage::disk('public')->exists($agenda->file_path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        $filePath = storage_path('app/public/' . $agenda->file_path);
        $fileName = Str::slug($agenda->title) . '.' . pathinfo($agenda->file_path, PATHINFO_EXTENSION);

        return response()->download($filePath, $fileName);
    }

    /**
     * Helper function untuk menentukan status agenda secara otomatis.
     */
    private function determineStatus($startDate, $endDate, $startTime, $endTime): AgendaStatus
    {
        $now = Carbon::now();
        $startDateTime = Carbon::parse($startDate . ' ' . ($startTime ?? '00:00:00'));
        $endDateTime = Carbon::parse(($endDate ?? $startDate) . ' ' . ($endTime ?? '23:59:59'));

        if ($now->lt($startDateTime)) {
            return AgendaStatus::UPCOMING;
        } elseif ($now->between($startDateTime, $endDateTime)) {
            return AgendaStatus::ONGOING;
        } else {
            return AgendaStatus::COMPLETED;
        }
    }
}
