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
     * @OA\Get(
     *     path="/api/visi-misi/statistics",
     *     operationId="getVisiMisiStatistics",
     *     tags={"Visi & Misi"},
     *     summary="Mendapatkan statistik visi dan misi",
     *     description="Mengembalikan statistik jumlah visi misi yang aktif dan tidak aktif",
     *     @OA\Response(
     *         response=200,
     *         description="Statistik visi dan misi berhasil diambil",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Statistik visi dan misi berhasil diambil"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="total", type="integer", example=5, description="Total semua visi misi"),
     *                 @OA\Property(property="active", type="integer", example=1, description="Jumlah visi misi aktif"),
     *                 @OA\Property(property="inactive", type="integer", example=4, description="Jumlah visi misi tidak aktif"),
     *                 @OA\Property(property="latest_update", type="string", format="date-time", example="2025-08-27T10:30:00.000000Z", description="Waktu update terakhir")
     *             )
     *         )
     *     )
     * )
     */
    public function statistics()
    {
        $total = VisiMisi::count();
        $active = VisiMisi::where('is_active', true)->count();
        $inactive = VisiMisi::where('is_active', false)->count();
        $latestUpdate = VisiMisi::latest('updated_at')->first()?->updated_at;

        return response()->json([
            'success' => true,
            'message' => 'Statistik visi dan misi berhasil diambil',
            'data' => [
                'total' => $total,
                'active' => $active,
                'inactive' => $inactive,
                'latest_update' => $latestUpdate,
            ]
        ]);
    }
}
