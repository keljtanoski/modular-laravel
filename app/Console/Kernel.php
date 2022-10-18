<?php

namespace App\Console;

use App\Modules\Core\Console\Commands\GenerateModule;
use App\Modules\Core\Console\Commands\GenerateModuleController;
use App\Modules\Core\Console\Commands\GenerateModuleException;
use App\Modules\Core\Console\Commands\GenerateModuleRequest;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by the application.
     *
     * @var array
     */
    protected $commands = [
        GenerateModule::class,
        GenerateModuleException::class,
        GenerateModuleRequest::class,
        GenerateModuleController::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
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
