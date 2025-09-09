<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;
use App\Models\Berita;
use App\Enums\BeritaStatus;
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
     * @OA\Response(response=200, description="Operasi berhasil", @OA\JsonContent(type="object", @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Berita"))))
     * )
     */
    public function index()
    {
        $beritas = Berita::where('status', BeritaStatus::PUBLISHED)
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
     * required={"title", "content"},
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="content", type="string"),
     * @OA\Property(property="thumbnail", type="string", format="binary")
     * )
     * )
     * ),
     * @OA\Response(response=201, description="Berita berhasil dibuat", @OA\JsonContent(ref="#/components/schemas/Berita")),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = BeritaStatus::DRAFT;
        $data['thumbnail'] = $this->handleFileUpload($request, 'thumbnail', 'beritas');

        $berita = Berita::create($data);

        return response()->json($berita, 201);
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
     * @OA\JsonContent(
     * required={"title", "content", "status"},
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="content", type="string"),
     * @OA\Property(property="status", type="string", enum={"draft", "published"})
     * )
     * ),
     * @OA\Response(response=200, description="Berita berhasil diperbarui", @OA\JsonContent(ref="#/components/schemas/Berita")),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function update(Request $request, Berita $berita)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => ['required', Rule::enum(BeritaStatus::class)],
        ]);

        $berita->update($data);

        return response()->json($berita);
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
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function destroy(Berita $berita)
    {
        if ($berita->thumbnail) {
            Storage::disk('public')->delete($berita->thumbnail);
        }
        $berita->delete();

        return response()->json(null, 204);
    }
}
