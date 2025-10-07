<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Run your invoice reminder command every minute
        $schedule->command('invoices:send-reminders')
            ->everyMinute()
            ->withoutOverlapping();
    }

    protected function commands()
    {
        // Load only your custom artisan commands
        $this->load(__DIR__ . '/Commands');

        
    }
}
