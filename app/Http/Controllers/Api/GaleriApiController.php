<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Traits\FileUploadTrait;
    use App\Models\Galeri;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;

    class GaleriApiController extends Controller
    {
        use FileUploadTrait;

        /**
         * @OA\Get(
         * path="/api/galeris",
         * operationId="getGaleriList",
         * tags={"Galeri"},
         * summary="Menampilkan daftar semua gambar di galeri",
         * @OA\Response(
         * response=200,
         * description="Operasi berhasil",
         * @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Galeri"))
         * )
         * )
         */
        public function index()
        {
            return response()->json(Galeri::latest()->get());
        }

        /**
         * @OA\Post(
         * path="/api/galeris",
         * operationId="storeGaleri",
         * tags={"Galeri"},
         * summary="Menambah gambar baru ke galeri (memerlukan token)",
         * security={ {"bearerAuth": {} }},
         * @OA\RequestBody(
         * required=true,
         * @OA\MediaType(
         * mediaType="multipart/form-data",
         * @OA\Schema(
         * required={"image"},
         * @OA\Property(property="title", type="string"),
         * @OA\Property(property="image", type="string", format="binary")
         * )
         * )
         * ),
         * @OA\Response(response=201, description="Gambar berhasil ditambahkan", @OA\JsonContent(ref="#/components/schemas/Galeri")),
         * @OA\Response(response=401, description="Unauthenticated")
         * )
         */
        public function store(Request $request)
        {
            $data = $request->validate([
                'title' => 'nullable|string|max:255',
                'image' => 'required|image|max:2048',
            ]);

            $data['image'] = $this->handleFileUpload($request, 'image', 'galeri');
            $galeri = Galeri::create($data);

            return response()->json($galeri, 201);
        }

        /**
         * @OA\Get(
         * path="/api/galeris/{id}",
         * operationId="getGaleriById",
         * tags={"Galeri"},
         * summary="Menampilkan detail satu gambar galeri",
         * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
         * @OA\Response(response=200, description="Operasi berhasil", @OA\JsonContent(ref="#/components/schemas/Galeri")),
         * @OA\Response(response=404, description="Data tidak ditemukan")
         * )
         */
        public function show(Galeri $galeri)
        {
            return response()->json($galeri);
        }

        /**
         * @OA\Delete(
         * path="/api/galeris/{id}",
         * operationId="deleteGaleri",
         * tags={"Galeri"},
         * summary="Menghapus gambar dari galeri (memerlukan token)",
         * security={ {"bearerAuth": {} }},
         * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
         * @OA\Response(response=204, description="Gambar berhasil dihapus"),
         * @OA\Response(response=401, description="Unauthenticated")
         * )
         */
        public function destroy(Galeri $galeri)
        {
            if ($galeri->image) {
                Storage::disk('public')->delete($galeri->image);
            }
            $galeri->delete();

            return response()->json(null, 204);
        }
    }
    