<?php

namespace Agenciafmd\Analytics\Http\Livewire;

use Agenciafmd\Leads\Models\Lead;

class CardLead extends Card
{
    protected function total(Array $period)
    {
        return Lead::query()
            ->whereBetween('created_at', $period)
            ->count() ?? 0;
    }
}
