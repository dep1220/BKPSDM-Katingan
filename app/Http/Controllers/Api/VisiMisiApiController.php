<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Visi & Misi",
 *     description="API untuk mengelola data visi dan misi organisasi"
 * )
 */
class VisiMisiApiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/visi-misi",
     *     operationId="getVisiMisiList",
     *     tags={"Visi & Misi"},
     *     summary="Mendapatkan daftar semua visi dan misi",
     *     description="Mengembalikan daftar semua visi dan misi yang tersedia dalam sistem",
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter berdasarkan status (active, inactive, all)",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"active", "inactive", "all"},
     *             default="all"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Nomor halaman untuk pagination",
     *         required=false,
     *         @OA\Schema(type="integer", minimum=1, default=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Jumlah item per halaman (maksimal 50)",
     *         required=false,
     *         @OA\Schema(type="integer", minimum=1, maximum=50, default=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Daftar visi dan misi berhasil diambil",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Daftar visi dan misi berhasil diambil"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(ref="#/components/schemas/VisiMisi")
     *                 ),
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="per_page", type="integer", example=10),
     *                 @OA\Property(property="total", type="integer", example=5),
     *                 @OA\Property(property="last_page", type="integer", example=1)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Parameter tidak valid",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Parameter tidak valid"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $request->validate([
            'status' => 'nullable|in:active,inactive,all',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:50',
        ]);

        $query = VisiMisi::query();

        // Filter berdasarkan status
        $status = $request->get('status', 'all');
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $perPage = min($request->get('per_page', 10), 50);
        $visiMisi = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Daftar visi dan misi berhasil diambil',
            'data' => [
                'data' => $visiMisi->items(),
                'current_page' => $visiMisi->currentPage(),
                'per_page' => $visiMisi->perPage(),
                'total' => $visiMisi->total(),
                'last_page' => $visiMisi->lastPage(),
            ]
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/visi-misi/active",
     *     operationId="getActiveVisiMisi",
     *     tags={"Visi & Misi"},
     *     summary="Mendapatkan visi dan misi yang sedang aktif",
     *     description="Mengembalikan data visi dan misi yang sedang aktif untuk ditampilkan di website publik",
     *     @OA\Response(
     *         response=200,
     *         description="Visi dan misi aktif berhasil diambil",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Visi dan misi aktif berhasil diambil"),
     *             @OA\Property(property="data", ref="#/components/schemas/VisiMisi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tidak ada visi dan misi yang aktif",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Tidak ada visi dan misi yang aktif")
     *         )
     *     )
     * )
     */
    public function active()
    {
        $visiMisi = VisiMisi::active()->first();

        if (!$visiMisi) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada visi dan misi yang aktif'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Visi dan misi aktif berhasil diambil',
            'data' => $visiMisi
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/visi-misi/{id}",
     *     operationId="getVisiMisiById",
     *     tags={"Visi & Misi"},
     *     summary="Mendapatkan detail visi dan misi berdasarkan ID",
     *     description="Mengembalikan detail lengkap dari visi dan misi berdasarkan ID yang diberikan",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID dari visi dan misi",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail visi dan misi berhasil diambil",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Detail visi dan misi berhasil diambil"),
     *             @OA\Property(property="data", ref="#/components/schemas/VisiMisi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Visi dan misi tidak ditemukan",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Visi dan misi tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $visiMisi = VisiMisi::find($id);

        if (!$visiMisi) {
            return response()->json([
                'success' => false,
                'message' => 'Visi dan misi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail visi dan misi berhasil diambil',
            'data' => $visiMisi
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/visi-misi",
     *     operationId="storeVisiMisi",
     *     tags={"Visi & Misi"},
     *     summary="Menyimpan visi dan misi baru",
     *     description="Menyimpan data visi dan misi baru ke database dan mengaktifkannya",
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Data visi dan misi yang akan disimpan",
     *         @OA\JsonContent(
     *             required={"visi", "misi"},
     *             @OA\Property(
     *                 property="visi",
     *                 type="string",
     *                 description="Teks visi organisasi (minimal 20 karakter)",
     *                 example="Menjadi institusi terdepan dalam pengembangan sumber daya manusia yang profesional dan berintegritas"
     *             ),
     *             @OA\Property(
     *                 property="misi",
     *                 type="array",
     *                 description="Array berisi misi organisasi (minimal 1 misi, setiap misi minimal 10 karakter)",
     *                 @OA\Items(
     *                     type="string",
     *                     example="Mengembangkan kompetensi aparatur sipil negara"
     *                 ),
     *                 minItems=1
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Visi dan misi berhasil disimpan",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Visi dan Misi berhasil ditambahkan dan diaktifkan"),
     *             @OA\Property(property="data", ref="#/components/schemas/VisiMisi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Data tidak valid",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Data tidak valid"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="visi",
     *                     type="array",
     *                     @OA\Items(type="string", example="Visi minimal 20 karakter.")
     *                 ),
     *                 @OA\Property(
     *                     property="misi",
     *                     type="array",
     *                     @OA\Items(type="string", example="Minimal harus ada 1 misi.")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Tidak terautentikasi",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
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

        return response()->json([
            'success' => true,
            'message' => 'Visi dan Misi berhasil ditambahkan dan diaktifkan',
            'data' => $visiMisi
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/visi-misi/{id}",
     *     operationId="updateVisiMisi",
     *     tags={"Visi & Misi"},
     *     summary="Memperbarui visi dan misi",
     *     description="Memperbarui data visi dan misi yang sudah ada",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID dari visi dan misi yang akan diperbarui",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Data visi dan misi yang akan diperbarui",
     *         @OA\JsonContent(
     *             required={"visi", "misi"},
     *             @OA\Property(
     *                 property="visi",
     *                 type="string",
     *                 description="Teks visi organisasi (minimal 20 karakter)",
     *                 example="Menjadi institusi terdepan dalam pengembangan sumber daya manusia yang profesional dan berintegritas"
     *             ),
     *             @OA\Property(
     *                 property="misi",
     *                 type="array",
     *                 description="Array berisi misi organisasi (minimal 1 misi, setiap misi minimal 10 karakter)",
     *                 @OA\Items(
     *                     type="string",
     *                     example="Mengembangkan kompetensi aparatur sipil negara"
     *                 ),
     *                 minItems=1
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Visi dan misi berhasil diperbarui",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Visi dan Misi berhasil diperbarui"),
     *             @OA\Property(property="data", ref="#/components/schemas/VisiMisi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Data tidak valid",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Data tidak valid"),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="visi",
     *                     type="array",
     *                     @OA\Items(type="string", example="Visi minimal 20 karakter.")
     *                 ),
     *                 @OA\Property(
     *                     property="misi",
     *                     type="array",
     *                     @OA\Items(type="string", example="Minimal harus ada 1 misi.")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Visi dan misi tidak ditemukan",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Visi dan misi tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Tidak terautentikasi",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $visiMisi = VisiMisi::find($id);

        if (!$visiMisi) {
            return response()->json([
                'success' => false,
                'message' => 'Visi dan misi tidak ditemukan'
            ], 404);
        }

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

        return response()->json([
            'success' => true,
            'message' => 'Visi dan Misi berhasil diperbarui',
            'data' => $visiMisi->fresh()
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/visi-misi/{id}",
     *     operationId="deleteVisiMisi",
     *     tags={"Visi & Misi"},
     *     summary="Menghapus visi dan misi",
     *     description="Menghapus data visi dan misi dari database",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID dari visi dan misi yang akan dihapus",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Visi dan misi berhasil dihapus",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Visi dan Misi berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Visi dan misi tidak ditemukan",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Visi dan misi tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Tidak terautentikasi",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $visiMisi = VisiMisi::find($id);

        if (!$visiMisi) {
            return response()->json([
                'success' => false,
                'message' => 'Visi dan misi tidak ditemukan'
            ], 404);
        }

        $visiMisi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Visi dan Misi berhasil dihapus'
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/visi-misi/{id}/activate",
     *     operationId="activateVisiMisi",
     *     tags={"Visi & Misi"},
     *     summary="Mengaktifkan visi dan misi",
     *     description="Mengaktifkan visi dan misi tertentu dan menonaktifkan yang lain",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID dari visi dan misi yang akan diaktifkan",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Visi dan misi berhasil diaktifkan",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Visi dan Misi berhasil diaktifkan"),
     *             @OA\Property(property="data", ref="#/components/schemas/VisiMisi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Visi dan misi tidak ditemukan",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Visi dan misi tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Tidak terautentikasi",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function activate($id)
    {
        $visiMisi = VisiMisi::find($id);

        if (!$visiMisi) {
            return response()->json([
                'success' => false,
                'message' => 'Visi dan misi tidak ditemukan'
            ], 404);
        }

        // Set semua visi misi lain menjadi tidak aktif
        VisiMisi::query()->update(['is_active' => false]);
        
        // Aktifkan visi misi yang dipilih
        $visiMisi->update(['is_active' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Visi dan Misi berhasil diaktifkan',
            'data' => $visiMisi->fresh()
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/visi-misi/{id}/deactivate",
     *     operationId="deactivateVisiMisi",
     *     tags={"Visi & Misi"},
     *     summary="Menonaktifkan visi dan misi",
     *     description="Menonaktifkan visi dan misi tertentu",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID dari visi dan misi yang akan dinonaktifkan",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Visi dan misi berhasil dinonaktifkan",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Visi dan Misi berhasil dinonaktifkan"),
     *             @OA\Property(property="data", ref="#/components/schemas/VisiMisi")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Visi dan misi tidak ditemukan",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Visi dan misi tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Tidak terautentikasi",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */
    public function deactivate($id)
    {
        $visiMisi = VisiMisi::find($id);

        if (!$visiMisi) {
            return response()->json([
                'success' => false,
                'message' => 'Visi dan misi tidak ditemukan'
            ], 404);
        }

        // Nonaktifkan visi misi yang dipilih
        $visiMisi->update(['is_active' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Visi dan Misi berhasil dinonaktifkan',
            'data' => $visiMisi->fresh()
        ]);
    }
}
