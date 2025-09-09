<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\JabatanEnum;

/**
 * @OA\Schema(
 * schema="Pejabat",
 * title="Pejabat",
 * description="Model untuk data struktur pejabat/organisasi",
 * @OA\Property(
 * property="id",
 * type="integer",
 * description="ID unik dari pejabat",
 * example=1
 * ),
 * @OA\Property(
 * property="name",
 * type="string",
 * description="Nama lengkap pejabat",
 * example="Dr. John Doe, S.H., M.Si"
 * ),
 * @OA\Property(
 * property="nip",
 * type="string",
 * description="Nomor Induk Pegawai",
 * example="196501010199103001"
 * ),
 * @OA\Property(
 * property="jabatan",
 * type="string",
 * enum={"Kepala Badan", "Sekretaris", "Kepala Bidang A", "Kepala Bidang B", "Staf Ahli"},
 * description="Jabatan dalam struktur organisasi",
 * example="Sekretaris"
 * ),
 * @OA\Property(
 * property="photo",
 * type="string",
 * description="Path relatif ke foto pejabat",
 * example="pejabat/photo.jpg"
 * ),
 * @OA\Property(
 * property="order",
 * type="integer",
 * description="Urutan tampil dalam struktur organisasi",
 * example=1
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * description="Waktu data dibuat"
 * ),
 * @OA\Property(
 * property="updated_at",
 * type="string",
 * format="date-time",
 * description="Waktu terakhir diperbarui"
 * )
 * )
 */
class Pejabat extends Model {
    use HasFactory;
    
    protected $fillable = ['name', 'nip', 'jabatan', 'photo', 'order'];
    
    protected $casts = [
        'jabatan' => JabatanEnum::class,
    ];
}