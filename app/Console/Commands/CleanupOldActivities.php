<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CleanupOldActivities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activities:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus riwayat aktivitas yang lebih dari 1 bulan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oneMonthAgo = Carbon::now()->subMonth();
        
        $deletedCount = ActivityLog::where('created_at', '<', $oneMonthAgo)->delete();
        
        $this->info("Berhasil menghapus {$deletedCount} riwayat aktivitas yang lebih dari 1 bulan.");
        
        return Command::SUCCESS;
    }
}
