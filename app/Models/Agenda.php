<?php

namespace App\Models;

use App\Enums\AgendaStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

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
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'status',
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
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        // 'status' => AgendaStatus::class,
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

    /**
     * Dapatkan status agenda secara dinamis (Accessor).
     * Versi ini lebih andal dalam menangani objek tanggal dan waktu.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function status(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // 1. Jika status di DB adalah 'Dibatalkan', langsung kembalikan.
                if ($value === AgendaStatus::CANCELLED->value) {
                    return AgendaStatus::CANCELLED;
                }

               $now = Carbon::now('Asia/Jakarta');

                // 2. Buat objek startDateTime dengan aman
                // Mulai dari awal hari tanggal mulai
                $startDateTime = $this->start_date->copy()->startOfDay();
                // Jika ada jam mulai, atur jamnya
                if ($this->start_time) {
                    $startDateTime->setTimeFromTimeString($this->start_time->format('H:i:s'));
                }

                // 3. Buat objek endDateTime dengan aman
                // Tentukan tanggal selesai (jika tidak ada, pakai tanggal mulai)
                $endDate = $this->end_date ?? $this->start_date;
                // Mulai dari akhir hari tanggal selesai
                $endDateTime = $endDate->copy()->endOfDay();
                // Jika ada jam selesai, atur jamnya
                if ($this->end_time) {
                    $endDateTime->setTimeFromTimeString($this->end_time->format('H:i:s'));
                }

                // 4. Logika perbandingan waktu
                if ($now->lt($startDateTime)) {
                    return AgendaStatus::UPCOMING;
                } elseif ($now->between($startDateTime, $endDateTime)) {
                    return AgendaStatus::ONGOING;
                } else {
                    return AgendaStatus::COMPLETED;
                }
            }
        );
    }

    /**
     * Method untuk auto-update status agenda berdasarkan waktu
     * 
     * @return void
     */
    public function updateStatusBasedOnTime()
    {
        // Jika status sudah dibatalkan, jangan ubah
        if ($this->status === AgendaStatus::CANCELLED) {
            return;
        }

        $now = now();
        $startDateTime = null;
        $endDateTime = null;

        // Buat datetime dari start_date dan start_time
        if ($this->start_date && $this->start_time) {
            $startDateTime = $this->start_date->copy()->setTimeFromTimeString($this->start_time);
        } elseif ($this->start_date) {
            $startDateTime = $this->start_date->copy()->startOfDay();
        }

        // Buat datetime dari end_date dan end_time
        if ($this->end_date && $this->end_time) {
            $endDateTime = $this->end_date->copy()->setTimeFromTimeString($this->end_time);
        } elseif ($this->end_date) {
            $endDateTime = $this->end_date->copy()->endOfDay();
        } elseif ($startDateTime) {
            // Jika tidak ada end_date, gunakan start_date + 2 jam sebagai default
            $endDateTime = $startDateTime->copy()->addHours(2);
        }

        $newStatus = null;

        // Tentukan status berdasarkan waktu
        if ($startDateTime && $endDateTime) {
            if ($now->lt($startDateTime)) {
                // Belum mulai
                $newStatus = AgendaStatus::UPCOMING;
            } elseif ($now->between($startDateTime, $endDateTime)) {
                // Sedang berlangsung
                $newStatus = AgendaStatus::ONGOING;
            } elseif ($now->gt($endDateTime)) {
                // Sudah selesai
                $newStatus = AgendaStatus::COMPLETED;
            }
        } elseif ($startDateTime) {
            if ($now->lt($startDateTime)) {
                $newStatus = AgendaStatus::UPCOMING;
            } else {
                $newStatus = AgendaStatus::COMPLETED;
            }
        }

        // Update status jika ada perubahan
        if ($newStatus && $this->status !== $newStatus) {
            $this->update(['status' => $newStatus]);
        }
    }

    /**
     * Scope untuk agenda yang perlu di-update statusnya
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNeedsStatusUpdate($query)
    {
        return $query->where('status', '!=', AgendaStatus::CANCELLED)
                    ->whereNotNull('start_date');
    }

    /**
     * Method static untuk batch update status semua agenda
     * 
     * @return int Jumlah agenda yang di-update
     */
    public static function batchUpdateStatus()
    {
        $agendas = self::needsStatusUpdate()->get();
        $updated = 0;

        foreach ($agendas as $agenda) {
            $oldStatus = $agenda->status;
            $agenda->updateStatusBasedOnTime();
            
            if ($agenda->status !== $oldStatus) {
                $updated++;
            }
        }

        return $updated;
    }
}
