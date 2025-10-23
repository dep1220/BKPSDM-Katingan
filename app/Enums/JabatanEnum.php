<?php

namespace App\Enums;

enum JabatanEnum: string
{
    case KEPALA_DINAS = 'KEPALA BADAN';
    case SEKRETARIS_BADAN = 'SEKRETARIS BADAN';
    case KEPALA_SUB_BAGIAN = 'KEPALA SUB BAGIAN UMUM DAN KEPEGAWAIAN';
    case KEPALA_SUB_PENGADAAN = 'KEPALA SUB BAGIAN KEUANGAN, PERENCANAAN, EVALUASI DAN PELAPORAN';
    case KEPALA_BIDANG_MUTASI = 'KEPALA BIDANG MUTASI, PENSIUN DAN KESEJAHTERAAN, PENGOLAHAN DATA DAN INFORMASI';
    case KEPALA_BIDANG_PENGADAAN = 'KEPALA BIDANG PENGADAAN, PENGEMBANGAN PENDIDIKAN DAN PELATIHAN';



    // Method untuk mendapatkan label yang user-friendly
    public function label(): string
    {
        return match($this) {
            self::KEPALA_DINAS => 'Kepala Badan',
            self::SEKRETARIS_BADAN => 'Sekretaris Badan',
            self::KEPALA_SUB_BAGIAN => 'Kepala Sub Bagian Umum dan Kepegawaian',
            self::KEPALA_SUB_PENGADAAN => 'Kepala Sub Bagian Keuangan, Perencanaan, Evaluasi dan Pelaporan',
            self::KEPALA_BIDANG_MUTASI => 'Kepala Bidang Mutasi, Pensiun dan Kesejahteraan, Pengolahan Data dan Informasi',
            self::KEPALA_BIDANG_PENGADAAN => 'Kepala Bidang Pengadaan, Pengembangan Pendidikan dan Pelatihan',
        };
    }

    // Method untuk mendapatkan prioritas urutan
    public function priority(): int
    {
        return match($this) {
            self::KEPALA_DINAS => 1,
            self::SEKRETARIS_BADAN => 2,
            self::KEPALA_SUB_BAGIAN => 3,
            self::KEPALA_SUB_PENGADAAN => 4,
            self::KEPALA_BIDANG_MUTASI => 5,
            self::KEPALA_BIDANG_PENGADAAN => 6,
        };
    }
}