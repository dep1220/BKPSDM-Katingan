<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Traits\FileUploadTrait;
    use App\Models\Unduhan;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;

    class UnduhanApiController extends Controller
    {
        use FileUploadTrait;

        /**
         * @OA\Get(
         * path="/api/unduhans",
         * operationId="getUnduhanList",
         * tags={"Unduhan"},
         * summary="Menampilkan daftar semua file unduhan",
         * @OA\Response(
         * response=200,
         * description="Operasi berhasil",
         * @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Unduhan"))
         * )
         * )
         */
        public function index()
        {
            return response()->json(Unduhan::latest()->get());
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
         * @OA\Property(property="title", type="string"),
         * @OA\Property(property="description", type="string", description="Deskripsi file (opsional)"),
         * @OA\Property(property="file", type="string", format="binary")
         * )
         * )
         * ),
         * @OA\Response(response=201, description="File berhasil diunggah", @OA\JsonContent(ref="#/components/schemas/Unduhan")),
         * @OA\Response(response=401, description="Unauthenticated")
         * )
         */
        public function store(Request $request)
        {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:10240', // Max 10MB
            ]);

            $data['file_path'] = $this->handleFileUpload($request, 'file', 'unduhan');
            unset($data['file']); // Hapus key 'file' karena tidak ada di database

            $unduhan = Unduhan::create($data);

            return response()->json($unduhan, 201);
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
         * @OA\Response(response=401, description="Unauthenticated")
         * )
         */
        public function destroy(Unduhan $unduhan)
        {
            // Hapus file jika ada dan path tidak kosong
            if ($unduhan->file_path && !empty(trim($unduhan->file_path))) {
                if (Storage::disk('public')->exists($unduhan->file_path)) {
                    Storage::disk('public')->delete($unduhan->file_path);
                }
            }
            
            $unduhan->delete();

            return response()->json(null, 204);
        }
    }
