<?php

namespace Agenciafmd\Analytics\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;
use Umami\Umami;

class CardRejection extends Component
{
    public string $label;

    public string $metrics;

    public string $dimensions;

    public string $period;

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

            return view('agenciafmd/analytics::livewire.card-rejection', $view);
        }

        $period = [
            'startAt' => Carbon::today()
                ->subDays($this->period - 1)
                ->startOfDay(),
            "endAt" => Carbon::today()
                ->endOfDay(),
        ];

        $total = $this->total($period);
        $indicator = 0;

        if ($this->format == 'integer') {
            $total = number_format($total,0);
        }

        if ($this->format == 'time') {
            $total = $total/6000;
            $time = explode('.',number_format($total,2));
            $total = date('i \m\i\n s \s', mktime(0, $time[0], $time[1], 1, 1, 2017));
        }

        if ($this->format == 'seconds') {
            $total = ($total <= 0) ? '< 1 s' : round($total, 2) . ' s';
            $indicator = 0;
        }

        $view['label'] = $this->label;
        $view['total'] = $total;
        $view['indicator'] = $indicator;

        return view('agenciafmd/analytics::livewire.card-rejection', $view);
    }

    protected function total(Array $period)
    {
        $uniques = Umami::query(config('analytics.site_id'),'stats',[
            'startAt'=> \Carbon\Carbon::now()->subMonth(),
            'endAt'=>Carbon::now(),
        ],true)['uniques']['value'];

        $sessions = Umami::query(config('analytics.site_id'),'pageviews',[
            'startAt'=>Carbon::now()->subYear(),
            'endAt'=>Carbon::now(),
            'unit' => 'year',
        ],true)['sessions'][0]['y'];

        return ($uniques/$sessions)*100;
    }

    private function indicator($totalPast, $total)
    {
        if ($total > 0) {
            return number_format((1 - $totalPast / $total) * 100,0) . '%';
        }
        return $totalPast;
    }
}
