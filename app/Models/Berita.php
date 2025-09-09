<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Enums\BeritaStatus;

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
 * description="Path relatif ke gambar thumbnail",
 * example="thumbnails/berita/image.jpg"
 * ),
 * @OA\Property(
 * property="user_id",
 * type="integer",
 * description="ID dari user penulis",
 * example=1
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
        'user_id',
        'published_at', // Tambahkan ini juga untuk nanti
        'status'
    ];

    protected $casts = [
        // <-- 2. TAMBAHKAN BLOK INI UNTUK MENGAKTIFKAN CASTING
        'status' => BeritaStatus::class,
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
}