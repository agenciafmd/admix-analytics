<?php

namespace Agenciafmd\Analytics\Providers;

use Agenciafmd\Analytics\Http\Livewire\Card;
use Agenciafmd\Analytics\Http\Livewire\CardLead;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('analytics::card', Card::class);
        Livewire::component('analytics::card-lead', CardLead::class);
    }

    public function register()
    {
        //
    }
}
