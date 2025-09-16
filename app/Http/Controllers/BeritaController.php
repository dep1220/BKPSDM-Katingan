<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BeritaController extends Controller
{
    use LogsActivity;
    
    /**
     * Compress and store image
     */
    private function compressAndStoreImage($imageFile, $folder = 'thumbnails/berita')
    {
        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.jpg';
        $path = $folder . '/' . $filename;
        $fullPath = storage_path('app/public/' . $path);
        
        // Ensure directory exists
        $directory = dirname($fullPath);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        
        // Get image info
        $imageInfo = getimagesize($imageFile->getPathname());
        $mimeType = $imageInfo['mime'];
        
        // Create image resource based on type
        switch ($mimeType) {
            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($imageFile->getPathname());
                break;
            case 'image/png':
                $sourceImage = imagecreatefrompng($imageFile->getPathname());
                break;
            case 'image/gif':
                $sourceImage = imagecreatefromgif($imageFile->getPathname());
                break;
            case 'image/webp':
                $sourceImage = imagecreatefromwebp($imageFile->getPathname());
                break;
            default:
                throw new \Exception('Unsupported image type');
        }
        
        // Get original dimensions
        $originalWidth = imagesx($sourceImage);
        $originalHeight = imagesy($sourceImage);
        
        // Calculate new dimensions (max 800px for thumbnails)
        $maxSize = 800;
        if ($originalWidth > $maxSize || $originalHeight > $maxSize) {
            if ($originalWidth > $originalHeight) {
                $newWidth = $maxSize;
                $newHeight = intval(($originalHeight * $maxSize) / $originalWidth);
            } else {
                $newHeight = $maxSize;
                $newWidth = intval(($originalWidth * $maxSize) / $originalHeight);
            }
        } else {
            $newWidth = $originalWidth;
            $newHeight = $originalHeight;
        }
        
        // Create new image
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        
        // For PNG transparency
        if ($mimeType == 'image/png') {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
        }
        
        // Resize image
        imagecopyresampled(
            $newImage, $sourceImage,
            0, 0, 0, 0,
            $newWidth, $newHeight,
            $originalWidth, $originalHeight
        );
        
        // Save as JPEG with 85% quality (higher quality for thumbnails)
        imagejpeg($newImage, $fullPath, 85);
        
        // Clean up memory
        imagedestroy($sourceImage);
        imagedestroy($newImage);
        
        return $path;
    }
    
    /**
     * Store attachment file (PDF/Word)
     */
    private function storeAttachmentFile($attachmentFile, $folder = 'attachments/berita')
    {
        // Generate unique filename dengan ekstensi asli
        $originalName = $attachmentFile->getClientOriginalName();
        $extension = $attachmentFile->getClientOriginalExtension();
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $path = $folder . '/' . $filename;
        
        // Store file ke storage/app/public menggunakan disk public
        $attachmentFile->storeAs($folder, $filename, 'public');
        
        return $path;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        
        $beritas = Berita::with('user')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%")
                      ->orWhereHas('user', function ($userQuery) use ($search) {
                          $userQuery->where('name', 'like', "%{$search}%")
                                   ->orWhere('email', 'like', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(request()->query());
            
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // app/Http/Controllers/BeritaController.php

    public function store(StoreBeritaRequest $request)
    {
        // 1. Ambil data tervalidasi dan simpan ke $data
        $data = $request->validated();

        // 2. Tambahkan user_id ke variabel $data yang sama
        $data['user_id'] = Auth::id(); // <-- INI PERBAIKANNYA

        // 3. Status sudah ada dari validated data, tidak perlu set manual

        // 4. Handle thumbnail (opsional untuk pengumuman, wajib untuk lainnya)
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->compressAndStoreImage($request->file('thumbnail'));
        } elseif ($data['kategori'] !== \App\Enums\BeritaKategori::PENGUMUMAN->value) {
            // Thumbnail wajib untuk kategori selain pengumuman
            return back()->withErrors(['thumbnail' => 'Thumbnail wajib untuk kategori ini.'])->withInput();
        }

        // 5. Handle file lampiran untuk kategori pengumuman
        if ($request->hasFile('lampiran_file') && $data['kategori'] === \App\Enums\BeritaKategori::PENGUMUMAN->value) {
            $data['lampiran_file'] = $this->storeAttachmentFile($request->file('lampiran_file'));
        }

        // 6. Buat record baru menggunakan $data yang sudah lengkap
        $berita = Berita::create($data);

        // 7. Log activity
        $this->logCreate($berita, "Menambahkan berita baru: {$berita->title}");

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBeritaRequest $request, Berita $berita)
    {
        // Simpan nilai lama untuk logging
        $oldValues = $berita->toArray();
        
        $validatedData = $request->validated();

        // Hanya update thumbnail jika ada file baru yang diupload
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($berita->thumbnail) {
                Storage::disk('public')->delete($berita->thumbnail);
            }
            // Upload thumbnail baru
            $validatedData['thumbnail'] = $this->compressAndStoreImage($request->file('thumbnail'));
        } else {
            // Jika tidak ada file baru, hapus thumbnail dari validated data agar tidak di-update
            unset($validatedData['thumbnail']);
        }

        // Handle file lampiran untuk kategori pengumuman
        if ($request->hasFile('lampiran_file') && $validatedData['kategori'] === \App\Enums\BeritaKategori::PENGUMUMAN->value) {
            // Hapus file lampiran lama jika ada
            if ($berita->lampiran_file) {
                Storage::disk('public')->delete($berita->lampiran_file);
            }
            // Upload file lampiran baru
            $validatedData['lampiran_file'] = $this->storeAttachmentFile($request->file('lampiran_file'));
        } elseif ($validatedData['kategori'] !== \App\Enums\BeritaKategori::PENGUMUMAN->value) {
            // Jika kategori bukan pengumuman, hapus file lampiran
            if ($berita->lampiran_file) {
                Storage::disk('public')->delete($berita->lampiran_file);
            }
            $validatedData['lampiran_file'] = null;
        } elseif (!$request->hasFile('lampiran_file')) {
            // Jika tidak ada file baru, hapus lampiran_file dari validated data agar tidak di-update
            unset($validatedData['lampiran_file']);
        }

        $berita->update($validatedData);

        // Log activity dengan perubahan
        $this->logUpdate($berita, $oldValues, "Mengubah berita: {$berita->title}");

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        $title = $berita->title;
        
        if ($berita->thumbnail) {
            Storage::disk('public')->delete($berita->thumbnail);
        }

        $this->logDelete($berita, "Menghapus berita: {$title}");
        $berita->delete();

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil dihapus!');
    }

    /**
     * Upload image for TinyMCE editor
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Max 2MB
        ]);

        try {
            if ($request->hasFile('file')) {
                // Compress and store image
                $imagePath = $this->compressAndStoreImage($request->file('file'), 'uploads/editor');
                
                // Return response for TinyMCE
                return response()->json([
                    'location' => asset('storage/' . $imagePath)
                ]);
            }
            
            return response()->json(['error' => 'No file uploaded'], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Upload failed: ' . $e->getMessage()], 500);
        }
    }
}
