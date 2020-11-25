<?php

namespace Agenciafmd\Analytics\Providers;

use Agenciafmd\Admix\View\Components\Ui;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadBladeComponents();

        $this->loadBladeDirectives();

        $this->loadBladeComposers();

        $this->loadViews();

        $this->publish();
    }

    public function register()
    {
        //
    }

    protected function loadBladeComponents()
    {
        //
    }

    protected function loadBladeComposers()
    {
        //
    }

    protected function loadBladeDirectives()
    {
        //
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agenciafmd/analytics');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admix-analytics');
    }

    protected function publish()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/agenciafmd/analytics'),
        ], 'admix-analytics:views');
    }
}
