<?php

namespace Agenciafmd\Analytics\Providers;

use Illuminate\Support\ServiceProvider;

class AnalyticsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->providers();

        $this->loadMigrations();

        $this->publish();
    }

    public function register()
    {
        $this->loadConfigs();
    }

    protected function providers()
    {
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);
    }

    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function loadConfigs()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/analytics.php', 'analytics');
    }

    protected function publish()
    {
        $this->publishes([
            __DIR__ . '/../config/analytics.php' => base_path('config/analytics.php'),
        ], 'admix-analytics:config');

        $this->publishes([
            __DIR__ . '/../resources/images' => public_path('images'),
        ], 'admix-analytics:assets');
    }
}
