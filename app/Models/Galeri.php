<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * schema="Galeri",
 * title="Galeri",
 * description="Model untuk data galeri",
 * @OA\Property(
 * property="id",
 * type="integer",
 * description="ID unik dari item galeri",
 * example=1
 * ),
 * @OA\Property(
 * property="title",
 * type="string",
 * description="Judul atau caption gambar",
 * example="Kegiatan Pelatihan Dasar"
 * ),
 * @OA\Property(
 * property="image",
 * type="string",
 * description="Path relatif ke file gambar",
 * example="galeri/image.jpg"
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * description="Waktu upload gambar"
 * )
 * )
 */

class Galeri extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', // <-- Pastikan 'title' ada di sini
        'image', // <-- dan 'image' juga
    ];
}