<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakApiController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/kontaks",
     * operationId="getKontakList",
     * tags={"Kontak"},
     * summary="Menampilkan daftar semua pesan kontak (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/KontakMessage"))
     * ),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function index()
    {
        return response()->json(Kontak::latest()->get());
    }

    /**
     * @OA\Post(
     * path="/api/kontaks",
     * operationId="storeKontak",
     * tags={"Kontak"},
     * summary="Mengirim pesan kontak baru",
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"name", "email", "subject", "message"},
     * @OA\Property(property="name", type="string", example="John Doe"),
     * @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     * @OA\Property(property="subject", type="string", example="Subjek Pesan"),
     * @OA\Property(property="message", type="string", example="Ini adalah pesan kontak dari pengguna")
     * )
     * ),
     * @OA\Response(response=201, description="Pesan berhasil dikirim", @OA\JsonContent(ref="#/components/schemas/KontakMessage")),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $kontak = Kontak::create($data);

        return response()->json($kontak, 201);
    }

    /**
     * @OA\Get(
     * path="/api/kontaks/{id}",
     * operationId="getKontakById",
     * tags={"Kontak"},
     * summary="Menampilkan detail satu pesan kontak (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Operasi berhasil", @OA\JsonContent(ref="#/components/schemas/KontakMessage")),
     * @OA\Response(response=404, description="Data tidak ditemukan"),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function show(Kontak $kontak)
    {
        return response()->json($kontak);
    }

    /**
     * @OA\Delete(
     * path="/api/kontaks/{id}",
     * operationId="deleteKontak",
     * tags={"Kontak"},
     * summary="Menghapus pesan kontak (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=204, description="Pesan berhasil dihapus"),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
        return response()->json(null, 204);
    }
}
