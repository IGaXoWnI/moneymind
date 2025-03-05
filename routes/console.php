<?php

use Illuminate\Foundation\Inspiring;
use App\Console\Commands\subscription;
use App\Console\Commands\salaireUpdate;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(salaireUpdate::class)->daily();
Schedule::command(subscription::class)->daily();
