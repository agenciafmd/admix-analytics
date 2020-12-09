<?php

namespace Agenciafmd\Analytics\Http\Livewire;

use Agenciafmd\Leads\Models\Lead;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class CardLead extends Card
{
    protected function total(Period $period)
    {
        return Lead::query()
            ->whereBetween('created_at', [$period->startDate, $period->endDate])
            ->count() ?? 0;
    }
}
