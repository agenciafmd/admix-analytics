<?php

namespace Agenciafmd\Analytics\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadBladeComponents();

        $this->loadBladeDirectives();

        $this->loadBladeComposers();

        $this->setMenu();

        $this->loadViews();

        $this->publish();
    }

    public function register(): void
    {
        //
    }

    private function loadBladeComponents(): void
    {
        Blade::componentNamespace('Agenciafmd\\Analytics\\Http\\Components', 'admix-analytics');
    }

    private function loadBladeComposers(): void
    {
        //
    }

    private function loadBladeDirectives(): void
    {
        //
    }

    private function setMenu(): void
    {
        //
    }

    private function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'agenciafmd/analytics');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admix-analytics');
    }

    private function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/agenciafmd/analytics'),
        ], 'admix-analytics:views');
    }
}
