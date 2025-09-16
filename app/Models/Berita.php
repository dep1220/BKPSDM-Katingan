<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Enums\BeritaStatus;
use App\Enums\BeritaKategori;

/**
 * @OA\Schema(
 * schema="Berita",
 * title="Berita",
 * description="Model untuk data berita",
 * @OA\Property(
 * property="id",
 * type="integer",
 * description="ID unik dari berita",
 * example=1
 * ),
 * @OA\Property(
 * property="title",
 * type="string",
 * description="Judul berita",
 * example="BKPSDM Katingan Mengadakan Pelatihan"
 * ),
 * @OA\Property(
 * property="content",
 * type="string",
 * description="Isi lengkap dari berita dalam format HTML"
 * ),
 * @OA\Property(
 * property="thumbnail",
 * type="string",
 * nullable=true,
 * description="Path relatif ke gambar thumbnail",
 * example="thumbnails/berita/image.jpg"
 * ),
 * @OA\Property(
 * property="kategori",
 * type="string",
 * enum={"pengumuman", "berita_harian", "berita_utama"},
 * description="Kategori berita",
 * example="pengumuman"
 * ),
 * @OA\Property(
 * property="status",
 * type="string",
 * enum={"draft", "published"},
 * description="Status publikasi berita",
 * example="published"
 * ),
 * @OA\Property(
 * property="lampiran_file",
 * type="string",
 * nullable=true,
 * description="Path relatif ke file lampiran (untuk kategori pengumuman)",
 * example="attachments/berita/document.pdf"
 * ),
 * @OA\Property(
 * property="user_id",
 * type="integer",
 * description="ID dari user penulis",
 * example=1
 * ),
 * @OA\Property(
 * property="slug",
 * type="string",
 * description="Slug URL-friendly dari judul berita",
 * example="bkpsdm-katingan-mengadakan-pelatihan"
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * description="Waktu pembuatan berita"
 * ),
 * @OA\Property(
 * property="updated_at",
 * type="string",
 * format="date-time",
 * description="Waktu terakhir update berita"
 * )
 * )
 */

class Berita extends Model
{
    use HasFactory, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
        'kategori',
        'lampiran_file',
        'user_id',
        'published_at', // Tambahkan ini juga untuk nanti
        'status'
    ];

    protected $casts = [
        // <-- 2. TAMBAHKAN BLOK INI UNTUK MENGAKTIFKAN CASTING
        'status' => BeritaStatus::class,
        'kategori' => BeritaKategori::class,
    ];

    /**
     * Get the user that owns the berita.
     */

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title') // Ambil sumber slug dari kolom 'title'
            ->saveSlugsTo('slug');      // Simpan hasilnya ke kolom 'slug'
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get file extension from lampiran_file
     */
    public function getFileExtension()
    {
        if (!$this->lampiran_file) {
            return null;
        }
        return strtolower(pathinfo($this->lampiran_file, PATHINFO_EXTENSION));
    }

    /**
     * Get file icon based on extension
     */
    public function getFileIcon()
    {
        $extension = $this->getFileExtension();
        
        switch ($extension) {
            case 'pdf':
                return '📄'; // PDF icon
            case 'doc':
            case 'docx':
                return '📝'; // Word icon
            default:
                return '📎'; // Generic file icon
        }
    }

    /**
     * Get preview image for file (placeholder)
     */
    public function getFilePreviewUrl()
    {
        if (!$this->lampiran_file) {
            return null;
        }

        $extension = $this->getFileExtension();
        
        // Return placeholder image based on file type
        switch ($extension) {
            case 'pdf':
                return asset('img/previews/pdf-preview.svg');
            case 'doc':
            case 'docx':
                return asset('img/previews/word-preview.svg');
            default:
                return asset('img/previews/pdf-preview.svg'); // Default to PDF preview
        }
    }

    /**
     * Check if this berita has downloadable file
     */
    public function hasDownloadableFile()
    {
        return !empty($this->lampiran_file) && $this->kategori === BeritaKategori::PENGUMUMAN;
    }
}