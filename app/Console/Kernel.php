<?php

namespace App\Console;

use App\Console\Commands\DeactivateExpiredProductsCommand;
use App\Jobs\EndPromotionsJob;
use App\Jobs\PromotionSendPushJob;
use App\Jobs\RemoveArchivedProductsJob;
use App\Jobs\SaveEuroRubCourseJob;
use App\Jobs\StorefrontsRemovingJob;
use App\Jobs\TestJob;
use App\Jobs\ValidationRequestsDeleteJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\CompletePromotionJob;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        DeactivateExpiredProductsCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new CompletePromotionJob(), 'low')->everyMinute();
        $schedule->job(new StorefrontsRemovingJob(), 'low')->everyMinute();
        $schedule->job(new RemoveArchivedProductsJob(), 'low')->everyMinute();
        $schedule->job(new SaveEuroRubCourseJob(), 'low')->dailyAt('00:00');
        $schedule->job(new ValidationRequestsDeleteJob(), 'low')->everyMinute();
        $schedule->job(new EndPromotionsJob(), 'low')->everyMinute();
        $schedule->job(new PromotionSendPushJob(), 'low')->dailyAt('10:00');

        $schedule->command(DeactivateExpiredProductsCommand::class)->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
