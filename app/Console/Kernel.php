<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function (){
            Log::info("Eksekusi Ubah Status Tenant Jadi Belum ditagih");
        })->dailyAt('00:00');
        $schedule->command('tenant:belum-ditagih')->dailyAt('00:01');

        $schedule->call(function () {
            Log::info("Eksekusi Auto Menunggak");
        })->dailyAt('23:00');
        $schedule->command('tunggakan:cek')->dailyAt('23:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
