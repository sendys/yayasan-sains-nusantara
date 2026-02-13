<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule untuk mengupdate lisensi expired setiap hari pada jam 00:01
Schedule::command('license:update-expired')
    ->dailyAt('00:01')
    ->withoutOverlapping()
    ->runInBackground();
