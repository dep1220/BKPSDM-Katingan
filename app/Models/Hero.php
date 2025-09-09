<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * schema="Hero",
 * title="Hero",
 * description="Model untuk data slide hero/banner halaman utama",
 * @OA\Property(
 * property="id",
 * type="integer",
 * description="ID unik dari slide hero",
 * example=1
 * ),
 * @OA\Property(
 * property="title",
 * type="string",
 * description="Judul utama slide",
 * example="Selamat Datang di BKPSDM Katingan"
 * ),
 * @OA\Property(
 * property="subtitle",
 * type="string",
 * description="Sub judul atau deskripsi slide",
 * example="Melayani dengan Sepenuh Hati untuk Kemajuan Aparatur"
 * ),
 * @OA\Property(
 * property="background_image",
 * type="string",
 * description="Path relatif ke gambar latar belakang",
 * example="hero/background.jpg"
 * ),
 * @OA\Property(
 * property="button_text",
 * type="string",
 * description="Teks tombol call-to-action",
 * example="Selengkapnya"
 * ),
 * @OA\Property(
 * property="button_link",
 * type="string",
 * format="url",
 * description="Link tujuan tombol",
 * example="https://bkpsdm-katingan.go.id/layanan"
 * ),
 * @OA\Property(
 * property="order",
 * type="integer",
 * description="Urutan tampil slide",
 * example=1
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * description="Waktu slide dibuat"
 * ),
 * @OA\Property(
 * property="updated_at",
 * type="string",
 * format="date-time",
 * description="Waktu terakhir diperbarui"
 * )
 * )
 */
class Hero extends Model {
    use HasFactory;
    
    protected $fillable = [
        'title', 'subtitle', 'background_image', 'button_text', 'button_link', 'order',
    ];
}