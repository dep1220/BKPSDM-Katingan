<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @OA\Schema(
 * schema="Agenda",
 * title="Agenda",
 * description="Model untuk data agenda kegiatan dan rapat",
 * @OA\Property(
 * property="id",
 * type="integer",
 * description="ID unik dari agenda",
 * example=1
 * ),
 * @OA\Property(
 * property="title",
 * type="string",
 * description="Judul agenda kegiatan atau rapat",
 * example="Rapat Koordinasi Bulanan BKPSDM"
 * ),
 * @OA\Property(
 * property="description",
 * type="string",
 * description="Deskripsi lengkap kegiatan agenda, tempat, dan detail acara",
 * example="Rapat koordinasi bulanan untuk evaluasi kinerja pegawai dan pembahasan program kerja bulan depan. Acara akan dilaksanakan di ruang rapat lantai 2 gedung BKPSDM pada pukul 09.00 WIB."
 * ),
 * @OA\Property(
 * property="file_path",
 * type="string",
 * nullable=true,
 * description="Path relatif ke file dokumen agenda (opsional)",
 * example="unduhan/agenda-rapat-koordinasi-januari-2025.pdf"
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * description="Waktu agenda dibuat",
 * example="2025-08-25T08:30:00.000000Z"
 * ),
 * @OA\Property(
 * property="updated_at",
 * type="string",
 * format="date-time",
 * description="Waktu agenda terakhir diperbarui",
 * example="2025-08-25T10:15:00.000000Z"
 * )
 * )
 */

class Agenda extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'agendas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'file_path',
    ];

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($agenda) {
            if (empty($agenda->slug)) {
                $agenda->slug = Str::slug($agenda->title);
            }
        });
        
        static::updating(function ($agenda) {
            if ($agenda->isDirty('title') && empty($agenda->slug)) {
                $agenda->slug = Str::slug($agenda->title);
            }
        });
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scope untuk pencarian agenda berdasarkan judul atau deskripsi
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $searchTerm
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('title', 'like', '%' . $searchTerm . '%')
              ->orWhere('description', 'like', '%' . $searchTerm . '%');
        });
    }

    /**
     * Scope untuk filter berdasarkan bulan
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $month
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByMonth($query, $month)
    {
        return $query->whereMonth('created_at', $month);
    }

    /**
     * Scope untuk filter berdasarkan tahun
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $year
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByYear($query, $year)
    {
        return $query->whereYear('created_at', $year);
    }

    /**
     * Accessor untuk mendapatkan nama file dari path
     * 
     * @return string|null
     */
    public function getFileNameAttribute()
    {
        if (!$this->file_path) {
            return null;
        }
        
        return basename($this->file_path);
    }

    /**
     * Accessor untuk mendapatkan URL download file
     * 
     * @return string|null
     */
    public function getDownloadUrlAttribute()
    {
        if (!$this->file_path) {
            return null;
        }
        
        return route('api.agendas.download', $this);
    }

    /**
     * Accessor untuk mendapatkan excerpt dari deskripsi
     * 
     * @param int $length
     * @return string
     */
    public function getExcerpt($length = 150)
    {
        if (strlen($this->description) <= $length) {
            return $this->description;
        }
        
        return substr($this->description, 0, $length) . '...';
    }

    /**
     * Method untuk mengecek apakah agenda memiliki file
     * 
     * @return bool
     */
    public function hasFile()
    {
        return !empty($this->file_path) && Storage::disk('public')->exists($this->file_path);
    }

    /**
     * Method untuk mendapatkan ukuran file dalam format yang mudah dibaca
     * 
     * @return string|null
     */
    public function getFileSizeAttribute()
    {
        if (!$this->hasFile()) {
            return null;
        }
        
        $filePath = storage_path('app/public/' . $this->file_path);
        $bytes = filesize($filePath);
        
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}
