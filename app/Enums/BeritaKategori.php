<?php

namespace App\Enums;

enum BeritaKategori: string
{
    case PENGUMUMAN = 'pengumuman';
    case BERITA_HARIAN = 'berita_harian';
    case BERITA_UTAMA = 'berita_utama';

    /**
     * Get the label for the kategori
     */
    public function label(): string
    {
        return match($this) {
            self::PENGUMUMAN => 'Pengumuman',
            self::BERITA_HARIAN => 'Berita Harian',
            self::BERITA_UTAMA => 'Berita Utama',
        };
    }

    /**
     * Get all kategori with labels
     */
    public static function options(): array
    {
        return [
            self::PENGUMUMAN->value => self::PENGUMUMAN->label(),
            self::BERITA_HARIAN->value => self::BERITA_HARIAN->label(),
            self::BERITA_UTAMA->value => self::BERITA_UTAMA->label(),
        ];
    }

    /**
     * Check if kategori allows file attachment
     */
    public function allowsFileAttachment(): bool
    {
        return $this === self::PENGUMUMAN;
    }
}