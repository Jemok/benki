<?php

namespace App\Console;

use App\Console\Commands\DeductFixedAmountSaving;
use App\Console\Commands\DeductFixedAmountSavingMonthly;
use App\Console\Commands\DeductFixedAmountSavingWeekly;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

        Commands\Inspire::class,
        Commands\DeductSaving::class,
        Commands\DeductSavingWeekly::class,
        Commands\DeductSavingMonthly::class,
        DeductFixedAmountSaving::class,
        DeductFixedAmountSavingWeekly::class,
        DeductFixedAmountSavingMonthly::class,
        Commands\ManageFixed::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();

        $schedule->command('deduct:saving')->daily();

        $schedule->command('deduct:savingWeekly')->weekly();

        $schedule->command('deduct:savingMonthly')->monthly();

        $schedule->command('deduct:fixedAmountSaving')->daily();

        $schedule->command('deduct:fixedAmountSavingWeekly')->weekly();

        $schedule->command('deduct:fixedSavingMonthly')->monthly();

        $schedule->command('deduct:ManageFixed')->everyMinute();
    }
}
