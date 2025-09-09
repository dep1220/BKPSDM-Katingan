<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="VisiMisi",
 *     title="Visi & Misi",
 *     description="Model untuk data visi dan misi organisasi",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID unik dari visi misi",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="visi",
 *         type="string",
 *         description="Visi organisasi",
 *         example="Terwujudnya aparatur sipil negara Kabupaten Katingan yang profesional, berintegritas, dan berorientasi pelayanan publik untuk mendukung terwujudnya tata kelola pemerintahan yang baik."
 *     ),
 *     @OA\Property(
 *         property="misi",
 *         type="array",
 *         description="Daftar misi organisasi",
 *         @OA\Items(
 *             type="string",
 *             example="Meningkatkan kompetensi dan profesionalisme ASN melalui pengembangan karier dan pelatihan berkelanjutan."
 *         )
 *     ),
 *     @OA\Property(
 *         property="is_active",
 *         type="boolean",
 *         description="Status aktif visi misi (hanya satu yang boleh aktif)",
 *         example=true
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Waktu visi misi dibuat",
 *         example="2025-08-27T08:30:00.000000Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Waktu visi misi terakhir diperbarui",
 *         example="2025-08-27T10:15:00.000000Z"
 *     )
 * )
 */

class VisiMisi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'visi',
        'misi',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'misi' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope untuk data yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the active visi misi
     */
    public static function getActive()
    {
        return static::where('is_active', true)->first();
    }
}
