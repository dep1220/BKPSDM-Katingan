<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ActivityStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activities:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menampilkan statistik riwayat aktivitas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $totalActivities = ActivityLog::count();
        $thisMonth = ActivityLog::whereMonth('created_at', now()->month)->count();
        $thisWeek = ActivityLog::where('created_at', '>=', now()->startOfWeek())->count();
        $today = ActivityLog::whereDate('created_at', today())->count();
        
        $oldestActivity = ActivityLog::oldest()->first();
        $newestActivity = ActivityLog::latest()->first();
        
        $this->info("=== STATISTIK RIWAYAT AKTIVITAS ===");
        $this->line("Total Aktivitas: {$totalActivities}");
        $this->line("Bulan Ini: {$thisMonth}");
        $this->line("Minggu Ini: {$thisWeek}");
        $this->line("Hari Ini: {$today}");
        
        if ($oldestActivity) {
            $this->line("Aktivitas Tertua: " . $oldestActivity->created_at->format('d M Y H:i'));
        }
        
        if ($newestActivity) {
            $this->line("Aktivitas Terbaru: " . $newestActivity->created_at->format('d M Y H:i'));
        }
        
        $this->newLine();
        $this->comment("Aktivitas otomatis dihapus setelah 1 bulan.");
        
        return Command::SUCCESS;
    }
}
