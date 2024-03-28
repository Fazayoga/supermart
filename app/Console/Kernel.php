<?php

namespace App\Console;

use App\Console\Commands\CheckExpiredItems;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected $commands = [
        Commands\CheckExpiredItems::class,
    ];
    
    protected function schedule(Schedule $schedule)
    {
        // Menjadwalkan perintah check:expired-items untuk dijalankan setiap hari pukul 00:00
        $schedule->command(CheckExpiredItems::class)->daily();
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