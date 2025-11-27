<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Refresh Instagram token weekly (tokens last 60 days, so weekly is safe)
        $schedule->command('instagram:refresh-token')
                 ->weekly()
                 ->sundays()
                 ->at('03:00')
                 ->withoutOverlapping()
                 ->onSuccess(function () {
                     \Log::info('Instagram token refreshed via scheduler');
                 })
                 ->onFailure(function () {
                     \Log::error('Scheduled Instagram token refresh failed');
                 });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

