<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule untuk membersihkan aktivitas lama setiap hari jam 2 pagi
Schedule::command('activities:cleanup')->dailyAt('02:00');

// Schedule untuk update status agenda setiap 5 menit
Schedule::command('agenda:update-status')->everyFiveMinutes();
