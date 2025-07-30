<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule the faculty deadline reminders to run daily at 9:00 AM
Schedule::command('faculty:send-deadline-reminders')
    ->dailyAt('09:00')
    ->withoutOverlapping()
    ->runInBackground()
    ->sendOutputTo(storage_path('logs/faculty-reminders.log'), true);

// Also run at 2:00 PM for more frequent checking
Schedule::command('faculty:send-deadline-reminders')
    ->dailyAt('14:00')
    ->withoutOverlapping()
    ->runInBackground()
    ->sendOutputTo(storage_path('logs/faculty-reminders.log'), true);
