<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroApiController extends Controller
{
    use FileUploadTrait;

    /**
     * @OA\Get(
     * path="/api/heroes",
     * operationId="getHeroList",
     * tags={"Hero"},
     * summary="Menampilkan daftar semua slide hero/banner",
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Hero"))
     * )
     * )
     */
    public function index()
    {
        return response()->json(Hero::orderBy('order')->get());
    }

    /**
     * @OA\Post(
     * path="/api/heroes",
     * operationId="storeHero",
     * tags={"Hero"},
     * summary="Menambah slide hero/banner baru (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"background_image", "order"},
     * @OA\Property(property="title", type="string", example="Selamat Datang di BKPSDM Katingan"),
     * @OA\Property(property="subtitle", type="string", example="Melayani dengan Sepenuh Hati"),
     * @OA\Property(property="background_image", type="string", format="binary"),
     * @OA\Property(property="button_text", type="string", example="Selengkapnya"),
     * @OA\Property(property="button_link", type="string", format="url", example="https://example.com"),
     * @OA\Property(property="order", type="integer", example=1)
     * )
     * )
     * ),
     * @OA\Response(response=201, description="Slide hero berhasil ditambahkan", @OA\JsonContent(ref="#/components/schemas/Hero")),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'background_image' => 'required|image|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'order' => 'required|integer',
        ]);

        $data['background_image'] = $this->handleFileUpload($request, 'background_image', 'hero');
        $hero = Hero::create($data);

        return response()->json($hero, 201);
    }

    /**
     * @OA\Get(
     * path="/api/heroes/{id}",
     * operationId="getHeroById",
     * tags={"Hero"},
     * summary="Menampilkan detail satu slide hero/banner",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Operasi berhasil", @OA\JsonContent(ref="#/components/schemas/Hero")),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(Hero $hero)
    {
        return response()->json($hero);
    }

    /**
     * @OA\Put(
     * path="/api/heroes/{id}",
     * operationId="updateHero",
     * tags={"Hero"},
     * summary="Memperbarui slide hero/banner (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"order"},
     * @OA\Property(property="title", type="string"),
     * @OA\Property(property="subtitle", type="string"),
     * @OA\Property(property="button_text", type="string"),
     * @OA\Property(property="button_link", type="string", format="url"),
     * @OA\Property(property="order", type="integer")
     * )
     * ),
     * @OA\Response(response=200, description="Slide hero berhasil diperbarui", @OA\JsonContent(ref="#/components/schemas/Hero")),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function update(Request $request, Hero $hero)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|url',
            'order' => 'required|integer',
        ]);

        $hero->update($data);
        return response()->json($hero);
    }

    /**
     * @OA\Post(
     * path="/api/heroes/{id}/image",
     * operationId="updateHeroImage",
     * tags={"Hero"},
     * summary="Update background image slide hero (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"background_image"},
     * @OA\Property(property="background_image", type="string", format="binary")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Background image berhasil diperbarui", @OA\JsonContent(ref="#/components/schemas/Hero")),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function updateImage(Request $request, Hero $hero)
    {
        $request->validate([
            'background_image' => 'required|image|max:2048',
        ]);

        // Hapus gambar lama
        if ($hero->background_image) {
            Storage::disk('public')->delete($hero->background_image);
        }

        // Upload gambar baru
        $backgroundImage = $this->handleFileUpload($request, 'background_image', 'hero');
        $hero->update(['background_image' => $backgroundImage]);

        return response()->json($hero);
    }

    /**
     * @OA\Delete(
     * path="/api/heroes/{id}",
     * operationId="deleteHero",
     * tags={"Hero"},
     * summary="Menghapus slide hero/banner (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=204, description="Slide hero berhasil dihapus"),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function destroy(Hero $hero)
    {
        if ($hero->background_image) {
            Storage::disk('public')->delete($hero->background_image);
        }
        $hero->delete();

        return response()->json(null, 204);
    }
}
