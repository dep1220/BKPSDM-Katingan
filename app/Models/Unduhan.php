<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * schema="Unduhan",
 * title="Unduhan",
 * description="Model untuk data file unduhan",
 * @OA\Property(
 * property="id",
 * type="integer",
 * description="ID unik dari file unduhan",
 * example=1
 * ),
 * @OA\Property(
 * property="title",
 * type="string",
 * description="Judul atau nama file",
 * example="Dokumen SOP Kepegawaian 2025"
 * ),
 * @OA\Property(
 * property="description",
 * type="string",
 * description="Deskripsi file unduhan",
 * example="Standar Operasional Prosedur untuk pengelolaan kepegawaian di lingkungan BKPSDM tahun 2025."
 * ),
 * @OA\Property(
 * property="file_path",
 * type="string",
 * description="Path relatif ke file di storage",
 * example="unduhan/dokumen-sop-kepegawaian-2025.pdf"
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * description="Waktu file diunggah",
 * example="2025-08-25T08:30:00.000000Z"
 * ),
 * @OA\Property(
 * property="updated_at",
 * type="string",
 * format="date-time",
 * description="Waktu file terakhir diperbarui",
 * example="2025-08-25T10:15:00.000000Z"
 * )
 * )
 */

class Unduhan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
    ];
}