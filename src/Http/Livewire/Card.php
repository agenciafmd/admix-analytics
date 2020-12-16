<?php

namespace Agenciafmd\Analytics\Http\Livewire;

use Agenciafmd\Leads\Models\Lead;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class Card extends Component
{
    public string $label;

    public string $metrics;

    public string $dimensions;

    public string $period;

    /* integer | time | seconds */
    public string $format;

    public bool $readyToLoad = false;

    public function loadComponent()
    {
        $this->readyToLoad = true;
    }

    public function mount(
        $label = 'Usuários',
        $metrics = 'ga:users',
        $dimensions = 'ga:date',
        $period = 7,
        $format = 'integer'
    )
    {
        $this->label = $label;
        $this->metrics = $metrics;
        $this->dimensions = $dimensions;
        $this->period = $period;
        $this->format = $format;
    }

    public function render()
    {
        if (!$this->readyToLoad) {
            $view['label'] = $this->label;
            $view['total'] = 0;
            $view['indicator'] = 0;

            return view('agenciafmd/analytics::livewire.card', $view);
        }

        //de 13 a 7 dias atrás
        $period = Period::create(
            Carbon::yesterday()
                ->subDays($this->period * 2 - 1)
                ->startOfDay(),
            Carbon::yesterday()
                ->subDays($this->period)
                ->endOfDay()
        );
        $totalPast = $this->total($period);

        //de 7 dias atrás até ontem
        $period = Period::create(
            Carbon::yesterday()
                ->subDays($this->period - 1)
                ->startOfDay(),
            Carbon::yesterday()
                ->endOfDay()
        );
        $total = $this->total($period);
        $indicator = $this->indicator($totalPast, $total);

        if ($this->format == 'integer') {
            $total = human_number($total);
        }

        if ($this->format == 'time') {
            $total = date('i \m\i\n s \s', mktime(0, 0, $total, 1, 1, 2017));
        }

        if ($this->format == 'seconds') {
            $total = ($total <= 0) ? '< 1 s' : round($total, 2) . ' s';
            $indicator = 0;
        }

        $view['label'] = $this->label;
        $view['total'] = $total;
        $view['indicator'] = $indicator;

        return view('agenciafmd/analytics::livewire.card', $view);
    }

    protected function total(Period $period)
    {
        return Analytics::performQuery($period, $this->metrics, [
                'dimensions' => $this->dimensions,
            ])->totalsForAllResults[$this->metrics] ?? 0;
    }

    private function indicator($totalPast, $total)
    {
        if ($total > 0) {
            return human_number((1 - $totalPast / $total) * 100) . '%';
        }

        return $totalPast;
    }
}
