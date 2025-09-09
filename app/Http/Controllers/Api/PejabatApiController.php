<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;
use App\Models\Pejabat;
use App\Enums\JabatanEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PejabatApiController extends Controller
{
    use FileUploadTrait;

    /**
     * @OA\Get(
     * path="/api/pejabats",
     * operationId="getPejabatList",
     * tags={"Pejabat"},
     * summary="Menampilkan daftar semua pejabat/struktur organisasi",
     * @OA\Response(
     * response=200,
     * description="Operasi berhasil",
     * @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Pejabat"))
     * )
     * )
     */
    public function index()
    {
        return response()->json(Pejabat::orderBy('order')->get());
    }

    /**
     * @OA\Post(
     * path="/api/pejabats",
     * operationId="storePejabat",
     * tags={"Pejabat"},
     * summary="Menambah pejabat baru (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"name", "jabatan", "order"},
     * @OA\Property(property="name", type="string", example="John Doe"),
     * @OA\Property(property="jabatan", type="string", enum={"Kepala Badan", "Sekretaris", "Kepala Bidang A", "Kepala Bidang B", "Staf Ahli"}, example="Sekretaris"),
     * @OA\Property(property="nip", type="string", example="198512345678901234"),
     * @OA\Property(property="photo", type="string", format="binary"),
     * @OA\Property(property="order", type="integer", example=1)
     * )
     * )
     * ),
     * @OA\Response(response=201, description="Pejabat berhasil ditambahkan", @OA\JsonContent(ref="#/components/schemas/Pejabat")),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'jabatan' => ['required', Rule::enum(JabatanEnum::class)],
            'nip' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'order' => 'required|integer',
        ]);

        $data['photo'] = $this->handleFileUpload($request, 'photo', 'pejabat');
        $pejabat = Pejabat::create($data);

        return response()->json($pejabat, 201);
    }

    /**
     * @OA\Get(
     * path="/api/pejabats/{id}",
     * operationId="getPejabatById",
     * tags={"Pejabat"},
     * summary="Menampilkan detail satu pejabat",
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Operasi berhasil", @OA\JsonContent(ref="#/components/schemas/Pejabat")),
     * @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show(Pejabat $pejabat)
    {
        return response()->json($pejabat);
    }

    /**
     * @OA\Put(
     * path="/api/pejabats/{id}",
     * operationId="updatePejabat",
     * tags={"Pejabat"},
     * summary="Memperbarui data pejabat (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"name", "jabatan", "order"},
     * @OA\Property(property="name", type="string", example="John Doe"),
     * @OA\Property(property="jabatan", type="string", enum={"Kepala Badan", "Sekretaris", "Kepala Bidang A", "Kepala Bidang B", "Staf Ahli"}, example="Sekretaris"),
     * @OA\Property(property="nip", type="string", example="198512345678901234"),
     * @OA\Property(property="order", type="integer", example=1)
     * )
     * ),
     * @OA\Response(response=200, description="Pejabat berhasil diperbarui", @OA\JsonContent(ref="#/components/schemas/Pejabat")),
     * @OA\Response(response=401, description="Unauthenticated"),
     * @OA\Response(response=422, description="Validation Error")
     * )
     */
    public function update(Request $request, Pejabat $pejabat)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'jabatan' => ['required', Rule::enum(JabatanEnum::class)],
            'nip' => 'nullable|string|max:255',
            'order' => 'required|integer',
        ]);

        $pejabat->update($data);
        return response()->json($pejabat);
    }

    /**
     * @OA\Delete(
     * path="/api/pejabats/{id}",
     * operationId="deletePejabat",
     * tags={"Pejabat"},
     * summary="Menghapus pejabat (memerlukan token)",
     * security={ {"bearerAuth": {} }},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=204, description="Pejabat berhasil dihapus"),
     * @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function destroy(Pejabat $pejabat)
    {
        if ($pejabat->photo) {
            Storage::disk('public')->delete($pejabat->photo);
        }
        $pejabat->delete();

        return response()->json(null, 204);
    }
}
