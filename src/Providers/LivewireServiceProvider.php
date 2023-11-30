<?php

namespace Agenciafmd\Analytics\Providers;

use Agenciafmd\Analytics\Http\Livewire\Bar;
use Agenciafmd\Analytics\Http\Livewire\Card;
use Agenciafmd\Analytics\Http\Livewire\CardLead;
use Agenciafmd\Analytics\Http\Livewire\CardRejection;
use Agenciafmd\Analytics\Http\Livewire\Chart;
use Agenciafmd\Analytics\Http\Livewire\MostViewed;
use Agenciafmd\Analytics\Http\Livewire\Referrer;
use Agenciafmd\Analytics\Http\Livewire\SearchUrl;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('analytics::bar', Bar::class);
        Livewire::component('analytics::card', Card::class);
        Livewire::component('analytics::card-lead', CardLead::class);
        Livewire::component('analytics::chart', Chart::class);
        Livewire::component('analytics::most-viewed', MostViewed::class);
        Livewire::component('analytics::referrer', Referrer::class);
        Livewire::component('analytics::search-url', SearchUrl::class);
        Livewire::component('analytics::card-rejection', CardRejection::class);
    }

    public function register(): void
    {
        //
    }
}
