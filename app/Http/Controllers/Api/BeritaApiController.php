<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;
use App\Models\Berita;
use App\Enums\BeritaStatus;
use App\Enums\BeritaKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BeritaApiController extends Controller
{
    use FileUploadTrait;

    /**
     * @OA\Get(
     * path="/api/beritas",
     * operationId="getBeritaList",
     * tags={"Berita"},
     * summary="Menampilkan daftar berita yang sudah dipublikasi",
     * @OA\Parameter(
     * name="kategori",
     * in="query",
     * required=false,
     * @OA\Schema(type="string", enum={"pengumuman", "berita_harian", "berita_utama"}),
     * description="Filter berdasarkan kategori berita"
     * ),
     * @OA\Parameter(
     * name="search",
     * in="query",
     * required=false,
     * @OA\Schema(type="string"),
     * description="Pencarian berdasarkan judul atau konten"
     * ),
     * @OA\Response(response=200, description="Operasi berhasil", @OA\JsonContent(type="object", @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Berita"))))
     * )
     */
    public function index(Request $request)
    {
        $beritas = Berita::where('status', BeritaStatus::PUBLISHED)
                         ->when($request->kategori, function ($query, $kategori) {
                             return $query->where('kategori', $kategori);
                         })
                         ->when($request->search, function ($query, $search) {
                             return $query->where(function ($q) use ($search) {
                                 $q->where('title', 'like', "%{$search}%")
                                   ->orWhere('content', 'like', "%{$search}%");
                             });
                         })
                         ->with('user')
                         ->latest()
                         ->paginate(10);
        return response()->json($beritas);
    }

    /**
     * @OA\Get(
     * path="/api/beritas/{id}",
     * operationId="getBeritaById",
     * tags={"Berita"},
     * summary="Menampilkan detail satu berita",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Operasi berhasil", @OA\JsonContent(ref="#/components/schemas/Berita")),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(Berita $berita)
    {
        return response()->json($berita);
    }

    /**
     * @OA\Post(
     * path="/api/beritas",
     * operationId="storeBerita",
     * tags={"Berita"},
     * summary="Membuat berita baru (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"title", "content", "kategori", "status"},
     * @OA\Property(property="title", type="string", description="Judul berita"),
     * @OA\Property(property="content", type="string", description="Isi berita dalam format HTML"),
     * @OA\Property(property="kategori", type="string", enum={"pengumuman", "berita_harian", "berita_utama"}, description="Kategori berita"),
     * @OA\Property(property="status", type="string", enum={"draft", "published"}, description="Status publikasi"),
     * @OA\Property(property="thumbnail", type="string", format="binary", description="Gambar thumbnail (opsional untuk pengumuman)"),
     * @OA\Property(property="lampiran_file", type="string", format="binary", description="File lampiran PDF/Word (khusus untuk pengumuman)")
     * )
     * )
     * ),
     * @OA\Response(response=201, description="Berita berhasil dibuat", @OA\JsonContent(ref="#/components/schemas/Berita")),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'kategori' => ['required', Rule::enum(\App\Enums\BeritaKategori::class)],
            'status' => ['required', Rule::enum(BeritaStatus::class)],
            'thumbnail' => 'nullable|image|max:2048',
            'lampiran_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Max 10MB for documents
        ]);

        $data['user_id'] = Auth::id();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->handleFileUpload($request, 'thumbnail', 'thumbnails/berita');
        }

        // Handle attachment file for pengumuman
        if ($request->hasFile('lampiran_file') && $data['kategori'] === \App\Enums\BeritaKategori::PENGUMUMAN->value) {
            $data['lampiran_file'] = $this->handleFileUpload($request, 'lampiran_file', 'attachments/berita');
        }

        $berita = Berita::create($data);

        return response()->json($berita->load('user'), 201);
    }

    /**
     * @OA\Put(
     * path="/api/beritas/{id}",
     * operationId="updateBerita",
     * tags={"Berita"},
     * summary="Memperbarui berita yang ada (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"title", "content", "kategori", "status"},
     * @OA\Property(property="title", type="string", description="Judul berita"),
     * @OA\Property(property="content", type="string", description="Isi berita dalam format HTML"),
     * @OA\Property(property="kategori", type="string", enum={"pengumuman", "berita_harian", "berita_utama"}, description="Kategori berita"),
     * @OA\Property(property="status", type="string", enum={"draft", "published"}, description="Status publikasi"),
     * @OA\Property(property="thumbnail", type="string", format="binary", description="Gambar thumbnail baru (opsional)"),
     * @OA\Property(property="lampiran_file", type="string", format="binary", description="File lampiran baru (opsional, khusus pengumuman)")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Berita berhasil diperbarui", @OA\JsonContent(ref="#/components/schemas/Berita")),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=404, description="Berita tidak ditemukan"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function update(Request $request, Berita $berita)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'kategori' => ['required', Rule::enum(\App\Enums\BeritaKategori::class)],
            'status' => ['required', Rule::enum(BeritaStatus::class)],
            'thumbnail' => 'nullable|image|max:2048',
            'lampiran_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($berita->thumbnail) {
                Storage::disk('public')->delete($berita->thumbnail);
            }
            $data['thumbnail'] = $this->handleFileUpload($request, 'thumbnail', 'thumbnails/berita');
        }

        // Handle attachment file
        if ($request->hasFile('lampiran_file') && $data['kategori'] === \App\Enums\BeritaKategori::PENGUMUMAN->value) {
            // Delete old attachment
            if ($berita->lampiran_file) {
                Storage::disk('public')->delete($berita->lampiran_file);
            }
            $data['lampiran_file'] = $this->handleFileUpload($request, 'lampiran_file', 'attachments/berita');
        } elseif ($data['kategori'] !== \App\Enums\BeritaKategori::PENGUMUMAN->value) {
            // Remove attachment if category is not pengumuman
            if ($berita->lampiran_file) {
                Storage::disk('public')->delete($berita->lampiran_file);
            }
            $data['lampiran_file'] = null;
        }

        $berita->update($data);

        return response()->json($berita->load('user'));
    }

    /**
     * @OA\Delete(
     * path="/api/beritas/{id}",
     * operationId="deleteBerita",
     * tags={"Berita"},
     * summary="Menghapus berita (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=204, description="Berita berhasil dihapus"),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=404, description="Berita tidak ditemukan")
     * )
     */
    public function destroy(Berita $berita)
    {
        // Delete thumbnail if exists
        if ($berita->thumbnail) {
            Storage::disk('public')->delete($berita->thumbnail);
        }
        
        // Delete attachment file if exists
        if ($berita->lampiran_file) {
            Storage::disk('public')->delete($berita->lampiran_file);
        }
        
        $berita->delete();

        return response()->json(null, 204);
    }
    
    /**
     * Handle file upload to storage
     */
    private function handleFileUpload(Request $request, $fieldName, $folder)
    {
        if (!$request->hasFile($fieldName)) {
            return null;
        }

        $file = $request->file($fieldName);
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        
        return $file->storeAs($folder, $filename, 'public');
    }

    /**
     * @OA\Get(
     * path="/api/beritas/{id}/download",
     * operationId="downloadBeritaAttachment",
     * tags={"Berita"},
     * summary="Mengunduh file lampiran berita (khusus pengumuman)",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="File berhasil diunduh"),
     * @OA\Response(response=404, description="File tidak ditemukan atau berita bukan pengumuman"),
     * @OA\Response(response=422, description="Berita tidak memiliki file lampiran")
     * )
     */
    public function downloadAttachment(Berita $berita)
    {
        // Check if berita is pengumuman and has attachment
        if ($berita->kategori !== BeritaKategori::PENGUMUMAN || !$berita->lampiran_file) {
            return response()->json(['error' => 'File lampiran tidak tersedia'], 404);
        }

        $filePath = storage_path('app/public/' . $berita->lampiran_file);
        
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File tidak ditemukan'], 404);
        }

        $originalName = basename($berita->lampiran_file);
        
        return response()->download($filePath, $originalName);
    }
}
