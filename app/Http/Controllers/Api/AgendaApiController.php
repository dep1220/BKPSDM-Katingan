<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaApiController extends Controller
{
    use FileUploadTrait;

    /**
     * @OA\Get(
     * path="/api/agendas",
     * operationId="getAgendaList",
     * tags={"Agenda"},
     * summary="Menampilkan daftar semua agenda kegiatan",
     * @OA\Parameter(
     *     name="search",
     *     in="query",
     *     description="Pencarian berdasarkan judul atau deskripsi",
     *     @OA\Schema(type="string")
     * ),
     * @OA\Parameter(
     *     name="month",
     *     in="query",
     *     description="Filter berdasarkan bulan (1-12)",
     *     @OA\Schema(type="integer", minimum=1, maximum=12)
     * ),
     * @OA\Parameter(
     *     name="year",
     *     in="query",
     *     description="Filter berdasarkan tahun",
     *     @OA\Schema(type="integer")
     * ),
     * @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     description="Jumlah data per halaman (default: 10)",
     *     @OA\Schema(type="integer", minimum=1, maximum=100)
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Operasi berhasil",
     *     @OA\JsonContent(
     *         type="object",
     *         @OA\Property(property="current_page", type="integer", example=1),
     *         @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Agenda")),
     *         @OA\Property(property="first_page_url", type="string", example="http://127.0.0.1:8000/api/agendas?page=1"),
     *         @OA\Property(property="from", type="integer", example=1),
     *         @OA\Property(property="last_page", type="integer", example=5),
     *         @OA\Property(property="last_page_url", type="string", example="http://127.0.0.1:8000/api/agendas?page=5"),
     *         @OA\Property(property="next_page_url", type="string", nullable=true, example="http://127.0.0.1:8000/api/agendas?page=2"),
     *         @OA\Property(property="path", type="string", example="http://127.0.0.1:8000/api/agendas"),
     *         @OA\Property(property="per_page", type="integer", example=10),
     *         @OA\Property(property="prev_page_url", type="string", nullable=true),
     *         @OA\Property(property="to", type="integer", example=10),
     *         @OA\Property(property="total", type="integer", example=45)
     *     )
     * )
     * )
     */
    public function index(Request $request)
    {
        $query = Agenda::query();
        
        // Hapus filter kata kunci karena sekarang agenda sederhana
        // Tampilkan semua agenda tanpa filter kata kunci

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by month
        if ($request->filled('month')) {
            $query->byMonth($request->month);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->byYear($request->year);
        }

        $limit = $request->get('limit', 10);
        $limit = min(max($limit, 1), 100); // Batasi antara 1-100

        $agendas = $query->latest()->paginate($limit);

        return response()->json($agendas);
    }

    /**
     * @OA\Get(
     * path="/api/agendas/{slug}",
     * operationId="getAgendaBySlug",
     * tags={"Agenda"},
     * summary="Menampilkan detail satu agenda",
     * @OA\Parameter(name="slug", in="path", required=true, @OA\Schema(type="string"), example="contoh-agenda"),
     * @OA\Response(
     *     response=200,
     *     description="Operasi berhasil",
     *     @OA\JsonContent(ref="#/components/schemas/Agenda")
     * ),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(Agenda $agenda)
    {
        // Menggunakan model binding dengan slug
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
     *     required=true,
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *             required={"title", "description"},
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 maxLength=255,
     *                 description="Judul agenda kegiatan",
     *                 example="Rapat Koordinasi Bulanan"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string",
     *                 minLength=10,
     *                 description="Deskripsi detail kegiatan agenda (minimal 10 karakter)",
     *                 example="Rapat koordinasi bulanan untuk evaluasi kinerja pegawai dan pembahasan program kerja bulan depan."
     *             ),
     *             @OA\Property(
     *                 property="file",
     *                 type="string",
     *                 format="binary",
     *                 description="File dokumen agenda (opsional). Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Maksimal 10MB."
     *             )
     *         )
     *     )
     * ),
     * @OA\Response(
     *     response=201,
     *     description="Agenda berhasil dibuat",
     *     @OA\JsonContent(ref="#/components/schemas/Agenda")
     * ),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240', // Max 10MB
        ], [
            'title.required' => 'Judul agenda wajib diisi.',
            'title.max' => 'Judul agenda maksimal 255 karakter.',
            'description.required' => 'Deskripsi kegiatan wajib diisi.',
            'description.min' => 'Deskripsi kegiatan minimal 10 karakter.',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, XLS, XLSX, PPT, atau PPTX.',
            'file.max' => 'Ukuran file maksimal 10MB.',
        ]);

        // Handle file upload jika ada
        if ($request->hasFile('file')) {
            $data['file_path'] = $this->handleFileUpload($request, 'file', 'unduhan');
            unset($data['file']); // Hapus key 'file' karena tidak ada di database
        }

        $agenda = Agenda::create($data);

        return response()->json($agenda, 201);
    }

    /**
     * @OA\Put(
     * path="/api/agendas/{slug}",
     * operationId="updateAgenda",
     * tags={"Agenda"},
     * summary="Memperbarui agenda yang ada (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="slug", in="path", required=true, @OA\Schema(type="string"), example="contoh-agenda"),
     * @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *         @OA\Schema(
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 maxLength=255,
     *                 description="Judul agenda kegiatan (opsional untuk update)",
     *                 example="Rapat Koordinasi Bulanan API Updated"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string",
     *                 minLength=10,
     *                 description="Deskripsi detail kegiatan agenda (opsional untuk update, minimal 10 karakter jika diisi)",
     *                 example="Rapat koordinasi bulanan untuk evaluasi kinerja pegawai dan pembahasan program kerja bulan depan. Updated via API"
     *             ),
     *             @OA\Property(
     *                 property="file",
     *                 type="string",
     *                 format="binary",
     *                 description="File dokumen agenda (opsional). Format: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Maksimal 10MB."
     *             )
     *         )
     *     )
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Agenda berhasil diperbarui",
     *     @OA\JsonContent(ref="#/components/schemas/Agenda")
     * ),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=404, description="Data tidak ditemukan"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function update(Request $request, Agenda $agenda)
    {
        // Menggunakan model binding dengan slug
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|min:10',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240', // Max 10MB
        ], [
            'title.max' => 'Judul agenda maksimal 255 karakter.',
            'description.min' => 'Deskripsi kegiatan minimal 10 karakter.',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, XLS, XLSX, PPT, atau PPTX.',
            'file.max' => 'Ukuran file maksimal 10MB.',
        ]);

        // Hapus field yang null atau kosong dari array update
        $data = array_filter($data, function($value) {
            return $value !== null && $value !== '';
        });

        // Handle file upload jika ada
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($agenda->file_path && Storage::disk('public')->exists($agenda->file_path)) {
                Storage::disk('public')->delete($agenda->file_path);
            }
            
            $data['file_path'] = $this->handleFileUpload($request, 'file', 'unduhan');
            unset($data['file']); // Hapus key 'file' karena tidak ada di database
        }

        // Hanya update jika ada data yang akan diubah
        if (!empty($data)) {
            $agenda->update($data);
        }

        return response()->json($agenda);
    }

    /**
     * @OA\Delete(
     * path="/api/agendas/{slug}",
     * operationId="deleteAgenda",
     * tags={"Agenda"},
     * summary="Menghapus agenda (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="slug", in="path", required=true, @OA\Schema(type="string"), example="contoh-agenda"),
     * @OA\Response(response=204, description="Agenda berhasil dihapus"),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy(Agenda $agenda)
    {
        // Menggunakan model binding dengan slug
        // Hapus file jika ada dan path tidak kosong
        if ($agenda->file_path && !empty(trim($agenda->file_path))) {
            if (Storage::disk('public')->exists($agenda->file_path)) {
                Storage::disk('public')->delete($agenda->file_path);
            }
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
     * @OA\Parameter(name="slug", in="path", required=true, @OA\Schema(type="string"), example="contoh-agenda"),
     * @OA\Response(
     *     response=200,
     *     description="File berhasil diunduh",
     *     @OA\MediaType(mediaType="application/octet-stream")
     * ),
     * @OA\Response(response=404, description="Data atau file tidak ditemukan")
     * )
     */
    public function download(Agenda $agenda)
    {
        // Menggunakan model binding dengan slug
        if (!$agenda->file_path || !Storage::disk('public')->exists($agenda->file_path)) {
            return response()->json(['error' => 'File tidak ditemukan'], 404);
        }

        $filePath = storage_path('app/public/' . $agenda->file_path);
        $fileName = $agenda->title . '.' . pathinfo($agenda->file_path, PATHINFO_EXTENSION);

        return response()->download($filePath, $fileName);
    }
}
