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

            /*
             * evita que todos os crons do servidor compartilhado
             * rodem exatamente na mesma hora
             * */
            $minutes = cache()->rememberForever('schedule-minutes', function () {
                return str_pad(rand(0, 59), 2, 0, STR_PAD_LEFT);
            });

            $schedule->command('analytics:import')
                ->withoutOverlapping()
                ->dailyAt("05:{$minutes}")
                ->appendOutputTo(storage_path('logs/command-analytics-import-' . date('Y-m-d') . '.log'));

            $schedule->command('analytics:report')
                ->withoutOverlapping()
                ->weekly()
                ->mondays()
                ->at("09:{$minutes}")
                ->appendOutputTo(storage_path('logs/command-analytics-report-' . date('Y-m-d') . '.log'));
        });
    }
}
