<?php

namespace Agenciafmd\Analytics\Providers;

use Illuminate\Support\ServiceProvider;

class AnalyticsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->providers();

        $this->loadMigrations();

        $this->publish();
    }

    public function register(): void
    {
        $this->loadConfigs();
    }

    private function providers(): void
    {
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);
        $this->app->register(LivewireServiceProvider::class);
    }

    private function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/analytics.php' => base_path('config/analytics.php'),
        ], 'admix-analytics:config');

    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }


    private function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/analytics.php', 'analytics');
    }
}
