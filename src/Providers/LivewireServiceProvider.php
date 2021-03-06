<?php

namespace Agenciafmd\Analytics\Providers;

use Agenciafmd\Analytics\Http\Livewire\Bar;
use Agenciafmd\Analytics\Http\Livewire\Card;
use Agenciafmd\Analytics\Http\Livewire\CardLead;
use Agenciafmd\Analytics\Http\Livewire\Chart;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('analytics::bar', Bar::class);
        Livewire::component('analytics::card', Card::class);
        Livewire::component('analytics::card-lead', CardLead::class);
        Livewire::component('analytics::chart', Chart::class);
    }

    public function register()
    {
        //
    }
}
