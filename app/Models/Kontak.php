<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * schema="KontakMessage",
 * type="object",
 * title="Kontak Message",
 * description="Model data kontak/pesan dari pengguna",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="John Doe"),
 * @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 * @OA\Property(property="subject", type="string", example="Subjek Pesan"),
 * @OA\Property(property="message", type="string", example="Ini adalah pesan kontak"),
 * @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00Z"),
 * @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T00:00:00Z")
 * )
 */
class Kontak extends Model {
    use HasFactory;
    protected $fillable = ['name', 'email', 'subject', 'message'];
}