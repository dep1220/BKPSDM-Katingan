<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unduhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UnduhanApiController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/unduhans",
     * operationId="getUnduhanList",
     * tags={"Unduhan"},
     * summary="Menampilkan daftar semua file unduhan",
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(
     * type="array",
     * @OA\Items(
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="title", type="string", example="Dokumen Penting"),
     * @OA\Property(property="description", type="string", example="Deskripsi singkat dokumen."),
     * @OA\Property(property="file_path", type="string", readOnly=true),
     * @OA\Property(property="original_filename", type="string", readOnly=true, example="nama_asli_dokumen.pdf"),
     * @OA\Property(property="file_url", type="string", readOnly=true),
     * @OA\Property(property="created_at", type="string", format="date-time"),
     * @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     * )
     * )
     * )
     */
    public function index()
    {
        return response()->json(Unduhan::latest()->get());
    }

    /**
     * @OA\Get(
     * path="/api/unduhans/{id}",
     * operationId="getUnduhanById",
     * tags={"Unduhan"},
     * summary="Menampilkan detail satu file unduhan",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="title", type="string", example="Dokumen Penting"),
     * @OA\Property(property="description", type="string", example="Deskripsi singkat dokumen."),
     * @OA\Property(property="file_path", type="string", readOnly=true),
     * @OA\Property(property="original_filename", type="string", readOnly=true, example="nama_asli_dokumen.pdf"),
     * @OA\Property(property="file_url", type="string", readOnly=true),
     * @OA\Property(property="created_at", type="string", format="date-time"),
     * @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     * ),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(Unduhan $unduhan)
    {
        return response()->json($unduhan);
    }

    /**
     * @OA\Post(
     * path="/api/unduhans",
     * operationId="storeUnduhan",
     * tags={"Unduhan"},
     * summary="Mengunggah file baru (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"title", "file"},
     * @OA\Property(property="title", type="string", example="Judul File Baru"),
     * @OA\Property(property="description", type="string", description="Deskripsi file (opsional)", example="Ini adalah deskripsi file."),
     * @OA\Property(property="file", type="string", format="binary", description="File yang akan diunggah (Maks 5MB)")
     * )
     * )
     * ),
     * @OA\Response(response=201, description="File berhasil diunggah", @OA\JsonContent(
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="title", type="string", example="Dokumen Penting"),
     * @OA\Property(property="description", type="string", example="Deskripsi singkat dokumen."),
     * @OA\Property(property="file_path", type="string", readOnly=true),
     * @OA\Property(property="original_filename", type="string", readOnly=true, example="nama_asli_dokumen.pdf"),
     * @OA\Property(property="file_url", type="string", readOnly=true),
     * @OA\Property(property="created_at", type="string", format="date-time"),
     * @OA\Property(property="updated_at", type="string", format="date-time")
     * )),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,txt|max:5120', // Max 5MB
        ]);

        $file = $request->file('file');
        $data['file_path'] = $file->store('unduhan', 'public');
        // $data['original_filename'] = $file->getClientOriginalName(); // Opsional, lihat catatan di bawah
        unset($data['file']);

        $unduhan = Unduhan::create($data);

        return response()->json($unduhan, 201);
    }

    /**
     * @OA\Put(
     * path="/api/unduhans/{id}",
     * operationId="updateUnduhan",
     * tags={"Unduhan"},
     * summary="Memperbarui data unduhan (tanpa file)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="application/json",
     * @OA\Schema(
     * @OA\Property(property="title", type="string", example="Judul File Diperbarui"),
     * @OA\Property(property="description", type="string", example="Deskripsi diperbarui.")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Data berhasil diperbarui", @OA\JsonContent(
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="title", type="string", example="Dokumen Penting"),
     * @OA\Property(property="description", type="string", example="Deskripsi singkat dokumen."),
     * @OA\Property(property="file_path", type="string", readOnly=true),
     * @OA\Property(property="original_filename", type="string", readOnly=true, example="nama_asli_dokumen.pdf"),
     * @OA\Property(property="file_url", type="string", readOnly=true),
     * @OA\Property(property="created_at", type="string", format="date-time"),
     * @OA\Property(property="updated_at", type="string", format="date-time")
     * )),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=404, description="Data tidak ditemukan"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     * 
     * @OA\Post(
     * path="/api/unduhans/{id}/update-file",
     * operationId="updateUnduhanFile",
     * tags={"Unduhan"},
     * summary="Memperbarui file unduhan",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"file"},
     * @OA\Property(property="title", type="string", example="Judul File Diperbarui"),
     * @OA\Property(property="description", type="string", example="Deskripsi diperbarui."),
     * @OA\Property(property="file", type="string", format="binary", description="File baru untuk menggantikan yang lama (maksimal 5MB)")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="File berhasil diperbarui", @OA\JsonContent(
     * @OA\Property(property="id", type="integer", example=1),
     * @OA\Property(property="title", type="string", example="Dokumen Penting"),
     * @OA\Property(property="description", type="string", example="Deskripsi singkat dokumen."),
     * @OA\Property(property="file_path", type="string", readOnly=true),
     * @OA\Property(property="original_filename", type="string", readOnly=true, example="nama_asli_dokumen.pdf"),
     * @OA\Property(property="file_url", type="string", readOnly=true),
     * @OA\Property(property="created_at", type="string", format="date-time"),
     * @OA\Property(property="updated_at", type="string", format="date-time")
     * )),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=404, description="Data tidak ditemukan"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function update(Request $request, Unduhan $unduhan)
    {
        $data = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $unduhan->update($data);
        return response()->json($unduhan);
    }

    /**
     * Update file unduhan
     */
    public function updateFile(Request $request, Unduhan $unduhan)
    {
        $data = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:5120', // Max 5MB, hanya dokumen
        ]);

        // Hapus file lama jika ada
        if ($unduhan->file_path && Storage::disk('public')->exists($unduhan->file_path)) {
            Storage::disk('public')->delete($unduhan->file_path);
        }

        // Upload file baru
        $file = $request->file('file');
        $data['file_path'] = $file->store('unduhan', 'public');
        unset($data['file']);

        $unduhan->update($data);
        return response()->json($unduhan);
    }

    /**
     * @OA\Delete(
     * path="/api/unduhans/{id}",
     * operationId="deleteUnduhan",
     * tags={"Unduhan"},
     * summary="Menghapus file (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=204, description="File berhasil dihapus"),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function destroy(Unduhan $unduhan)
    {
        if ($unduhan->file_path && Storage::disk('public')->exists($unduhan->file_path)) {
            Storage::disk('public')->delete($unduhan->file_path);
        }

        $unduhan->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     * path="/api/unduhans/{id}/download",
     * operationId="downloadUnduhanFile",
     * tags={"Unduhan"},
     * summary="Mengunduh file unduhan",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="File berhasil diunduh", @OA\MediaType(mediaType="application/octet-stream")),
     * @OA\Response(response=404, description="Data atau file tidak ditemukan")
     * )
     */
    public function download(Unduhan $unduhan)
    {
        if (!$unduhan->file_path || !Storage::disk('public')->exists($unduhan->file_path)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        $filePath = storage_path('app/public/' . $unduhan->file_path);

        // Gunakan nama file asli jika ada, jika tidak, buat nama file dari judul
        $fileName = $unduhan->original_filename ?? Str::slug($unduhan->title) . '.' . pathinfo($filePath, PATHINFO_EXTENSION);

        return response()->download($filePath, $fileName);
    }
}
