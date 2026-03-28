<?php

namespace App\Console;

use App\Console\Commands\GenerateDailyPost;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array<int, class-string>
     */
    protected $commands = [
        GenerateDailyPost::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('posts:generate-daily')
            ->dailyAt('09:00')
            ->timezone('Europe/Amsterdam')
            ->withoutOverlapping()
            ->onFailure(function () {
                Log::error('Daily post generation schedule failed');
            });

        $schedule->command('queue:work --stop-when-empty')
            ->everyMinute()
            ->withoutOverlapping();
    }
}
