<?php

namespace App\Enums;

enum JabatanEnum: string
{
    case KEPALA_DINAS = 'Kepala Dinas';
    case SEKRETARIS = 'Sekretaris';
    case KEPALA_SUB_BAGIAN = 'Kasubag';
    case KEPALA_BIDANG = 'Kepala Bidang';
    case KEPALA_SEKSI = 'Kasi';

    // Method untuk mendapatkan label yang user-friendly
    public function label(): string
    {
        return match($this) {
            self::KEPALA_DINAS => 'Kepala Dinas',
            self::SEKRETARIS => 'Sekretaris',
            self::KEPALA_SUB_BAGIAN => 'Kasubag',
            self::KEPALA_BIDANG => 'Kepala Bidang',
            self::KEPALA_SEKSI => 'Kasi',
        };
    }

    // Method untuk mendapatkan prioritas urutan
    public function priority(): int
    {
        return match($this) {
            self::KEPALA_DINAS => 1,
            self::SEKRETARIS => 2,
            self::KEPALA_SUB_BAGIAN => 3,
            self::KEPALA_BIDANG => 4,
            self::KEPALA_SEKSI => 5,
        };
    }
}