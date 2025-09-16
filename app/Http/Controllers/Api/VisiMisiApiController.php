<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiApiController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/visi-misi",
     * operationId="getVisiMisiList",
     * tags={"Visi & Misi"},
     * summary="Menampilkan daftar visi dan misi",
     * @OA\Response(response=200, description="Operasi berhasil", @OA\JsonContent(type="object", @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/VisiMisi"))))
     * )
     */
    public function index()
    {
        $visiMisi = VisiMisi::latest()->paginate(10);
        return response()->json($visiMisi);
    }

    /**
     * @OA\Get(
     * path="/api/visi-misi/active",
     * operationId="getActiveVisiMisi",
     * tags={"Visi & Misi"},
     * summary="Menampilkan visi dan misi yang sedang aktif",
     * @OA\Response(response=200, description="Operasi berhasil", @OA\JsonContent(ref="#/components/schemas/VisiMisi")),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function active()
    {
        $visiMisi = VisiMisi::where('is_active', true)->first();

        if (!$visiMisi) {
            return response()->json(['message' => 'Tidak ada visi dan misi yang aktif'], 404);
        }

        return response()->json($visiMisi);
    }

    /**
     * @OA\Get(
     * path="/api/visi-misi/{id}",
     * operationId="getVisiMisiById",
     * tags={"Visi & Misi"},
     * summary="Menampilkan detail satu visi dan misi",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Operasi berhasil", @OA\JsonContent(ref="#/components/schemas/VisiMisi")),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(VisiMisi $visiMisi)
    {
        return response()->json($visiMisi);
    }

    /**
     * @OA\Post(
     * path="/api/visi-misi",
     * operationId="storeVisiMisi",
     * tags={"Visi & Misi"},
     * summary="Membuat visi dan misi baru (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"visi", "misi"},
     * @OA\Property(property="visi", type="string"),
     * @OA\Property(property="misi", type="array", @OA\Items(type="string"))
     * )
     * ),
     * @OA\Response(response=201, description="Visi dan misi berhasil dibuat", @OA\JsonContent(ref="#/components/schemas/VisiMisi")),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string|min:20',
            'misi' => 'required|array|min:1',
            'misi.*' => 'required|string|min:10',
        ], [
            'visi.required' => 'Visi wajib diisi.',
            'visi.min' => 'Visi minimal 20 karakter.',
            'misi.required' => 'Misi wajib diisi.',
            'misi.min' => 'Minimal harus ada 1 misi.',
            'misi.*.required' => 'Setiap misi wajib diisi.',
            'misi.*.min' => 'Setiap misi minimal 10 karakter.',
        ]);

        // Set semua visi misi lain menjadi tidak aktif
        VisiMisi::query()->update(['is_active' => false]);

        // Bersihkan array misi dari nilai kosong
        $misi = array_filter($request->misi, function($item) {
            return !empty(trim($item));
        });

        $visiMisi = VisiMisi::create([
            'visi' => $request->visi,
            'misi' => array_values($misi), // Reset index array
            'is_active' => true,
        ]);

        return response()->json($visiMisi, 201);
    }

    /**
     * @OA\Put(
     * path="/api/visi-misi/{id}",
     * operationId="updateVisiMisi",
     * tags={"Visi & Misi"},
     * summary="Memperbarui visi dan misi yang ada (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"visi", "misi"},
     * @OA\Property(property="visi", type="string"),
     * @OA\Property(property="misi", type="array", @OA\Items(type="string"))
     * )
     * ),
     * @OA\Response(response=200, description="Visi dan misi berhasil diperbarui", @OA\JsonContent(ref="#/components/schemas/VisiMisi")),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function update(Request $request, VisiMisi $visiMisi)
    {
        $request->validate([
            'visi' => 'required|string|min:20',
            'misi' => 'required|array|min:1',
            'misi.*' => 'required|string|min:10',
        ], [
            'visi.required' => 'Visi wajib diisi.',
            'visi.min' => 'Visi minimal 20 karakter.',
            'misi.required' => 'Misi wajib diisi.',
            'misi.min' => 'Minimal harus ada 1 misi.',
            'misi.*.required' => 'Setiap misi wajib diisi.',
            'misi.*.min' => 'Setiap misi minimal 10 karakter.',
        ]);

        // Bersihkan array misi dari nilai kosong
        $misi = array_filter($request->misi, function($item) {
            return !empty(trim($item));
        });

        $visiMisi->update([
            'visi' => $request->visi,
            'misi' => array_values($misi), // Reset index array
        ]);

        return response()->json($visiMisi);
    }

    /**
     * @OA\Delete(
     * path="/api/visi-misi/{id}",
     * operationId="deleteVisiMisi",
     * tags={"Visi & Misi"},
     * summary="Menghapus visi dan misi (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=204, description="Visi dan misi berhasil dihapus"),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function destroy(VisiMisi $visiMisi)
    {
        $visiMisi->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Post(
     * path="/api/visi-misi/{id}/activate",
     * operationId="activateVisiMisi",
     * tags={"Visi & Misi"},
     * summary="Mengaktifkan visi dan misi (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Visi dan misi berhasil diaktifkan", @OA\JsonContent(ref="#/components/schemas/VisiMisi")),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function activate(VisiMisi $visiMisi)
    {
        // Set semua visi misi lain menjadi tidak aktif
        VisiMisi::query()->update(['is_active' => false]);
        
        // Aktifkan visi misi yang dipilih
        $visiMisi->update(['is_active' => true]);

        return response()->json($visiMisi);
    }

    /**
     * @OA\Post(
     * path="/api/visi-misi/{id}/deactivate",
     * operationId="deactivateVisiMisi",
     * tags={"Visi & Misi"},
     * summary="Menonaktifkan visi dan misi (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Visi dan misi berhasil dinonaktifkan", @OA\JsonContent(ref="#/components/schemas/VisiMisi")),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function deactivate(VisiMisi $visiMisi)
    {
        // Nonaktifkan visi misi yang dipilih
        $visiMisi->update(['is_active' => false]);

        return response()->json($visiMisi);
    }
}