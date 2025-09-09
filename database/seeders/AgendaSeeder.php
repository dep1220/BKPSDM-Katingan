<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agenda;
use Carbon\Carbon;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agendas = [
            [
                'title' => 'Rapat Koordinasi Bulanan BKPSDM',
                'slug' => 'rapat-koordinasi-bulanan-bkpsdm',
                'description' => 'Rapat koordinasi bulanan untuk membahas evaluasi kinerja pegawai, program pelatihan, dan rencana kegiatan bulan berikutnya. Kegiatan ini dilaksanakan setiap bulan untuk memastikan koordinasi yang baik antar bidang.',
                'tanggal' => Carbon::now()->addDays(7),
                'file_path' => null,
            ],
            [
                'title' => 'Pelatihan Kepemimpinan untuk Pejabat Struktural',
                'slug' => 'pelatihan-kepemimpinan-untuk-pejabat-struktural',
                'description' => 'Program pelatihan kepemimpinan yang dirancang khusus untuk meningkatkan kompetensi manajerial pejabat struktural di lingkungan Pemerintah Kabupaten Katingan.',
                'tanggal' => Carbon::now()->addDays(14),
                'file_path' => null,
            ],
            [
                'title' => 'Sosialisasi Peraturan Disiplin PNS Terbaru',
                'slug' => 'sosialisasi-peraturan-disiplin-pns-terbaru',
                'description' => 'Kegiatan sosialisasi peraturan disiplin PNS terbaru kepada seluruh pegawai negeri sipil di lingkungan Pemerintah Kabupaten Katingan.',
                'tanggal' => Carbon::now()->addDays(21),
                'file_path' => null,
            ],
        ];

        foreach ($agendas as $agenda) {
            Agenda::updateOrCreate(
                ['slug' => $agenda['slug']],
                $agenda
            );
        }
    }
}
