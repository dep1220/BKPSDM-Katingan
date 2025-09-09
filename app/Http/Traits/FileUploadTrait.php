<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    /**
     * Handle file upload and return the path.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $fileKey The name of the file input in the form (e.g., 'thumbnail', 'image').
     * @param string $storagePath The folder to store the file in (e.g., 'berita', 'galeri').
     * @param object|null $model The existing model instance (for updates).
     * @param string|null $dbField The database field name for the file path (e.g., 'thumbnail', 'image_path').
     * @return string|null The path of the stored file.
     */
    public function handleFileUpload(Request $request, string $fileKey, string $storagePath, $model = null, string $dbField = null)
    {
        if ($request->hasFile($fileKey)) {
            // Hapus file lama jika ini adalah proses update dan file lama ada
            if ($model && $model->{$dbField}) {
                Storage::disk('public')->delete($model->{$dbField});
            }
            // Simpan file baru dan kembalikan path-nya
            return $request->file($fileKey)->store($storagePath, 'public');
        }

        // Jika tidak ada file baru, kembalikan path file yang lama (untuk update)
        return $model ? $model->{$dbField} : null;
    }
}
