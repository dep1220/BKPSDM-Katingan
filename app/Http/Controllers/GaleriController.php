<?php

namespace App\Http\Controllers;

use App\Http\Traits\LogsActivity;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    use LogsActivity;
    
    /**
     * Compress and store image
     */
    private function compressAndStoreImage($imageFile, $folder = 'galeri')
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
        
        // Calculate new dimensions (max 1200px)
        $maxSize = 1200;
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
        
        // Save as JPEG with 80% quality
        imagejpeg($newImage, $fullPath, 80);
        
        // Clean up memory
        imagedestroy($sourceImage);
        imagedestroy($newImage);
        
        return $path;
    }
    
    /**
     * Display a listing of the resource.
     */
     
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB maksimal
        ]);

        // Compress and store image
        $validated['image'] = $this->compressAndStoreImage($request->file('image'));

        $galeri = Galeri::create($validated);
        $this->logCreate($galeri, "Menambahkan gambar galeri: {$galeri->title}");

        return redirect()->route('galeri.index')->with('success', 'Gambar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $oldValues = $galeri->toArray();
        
        // Aturan validasi
        $rules = [
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // 2MB maksimal
        ];

        $data = $request->validate($rules);

        // Cek jika ada file gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama
            if ($galeri->image) {
                Storage::disk('public')->delete($galeri->image);
            }
            // 2. Compress and store new image
            $data['image'] = $this->compressAndStoreImage($request->file('image'));
        }

        // Update data di database
        $galeri->update($data);
        $this->logUpdate($galeri, $oldValues, "Mengubah gambar galeri: {$galeri->title}");

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        $title = $galeri->title ?? 'Tanpa judul';
        
        // Penting: Hapus file gambar dari storage dulu
        Storage::disk('public')->delete($galeri->image);

        $this->logDelete($galeri, "Menghapus gambar galeri: {$title}");
        // Hapus record dari database
        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Gambar berhasil dihapus!');
    
    }
}
