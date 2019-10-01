<?php

namespace Agenciafmd\Analytics\Providers;

use Agenciafmd\Analytics\Commands\AnalyticsImport;
use Agenciafmd\Analytics\Commands\AnalyticsReport;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            AnalyticsImport::class,
            AnalyticsReport::class,
        ]);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);

            $schedule->command('analytics:import')
                ->withoutOverlapping()
                ->dailyAt('04:00')
                ->appendOutputTo(storage_path('logs/command-analytics-import-' . date('Y-m-d') . '.log'));

//            $schedule->command('analytics:report')
//                ->withoutOverlapping()
//                ->weekly()
//                ->mondays()
//                ->at('9:00')
//                ->appendOutputTo(storage_path('logs/command-analytics-report-' . date('Y-m-d') . '.log'));
        });
    }
}
