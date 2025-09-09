<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        // Cek apakah sudah ada log logout dalam 5 detik terakhir untuk user yang sama
        $recentLog = ActivityLog::where('user_id', $event->user->id)
            ->where('action', 'LOGOUT')
            ->where('created_at', '>=', now()->subSeconds(5))
            ->exists();

        if ($recentLog) {
            return; // Skip jika sudah ada log logout baru-baru ini
        }

        ActivityLog::create([
            'user_id' => $event->user->id,
            'action' => 'LOGOUT',
            'description' => 'User berhasil logout dari sistem',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
