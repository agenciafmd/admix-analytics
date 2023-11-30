<?php

namespace Agenciafmd\Analytics\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;
use Umami\Umami;

class Card extends Component
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
        $label = 'Visualizações',
        $metrics = 'stats:pageviews',
        $dimensions = 'stats:pageviews',
        $period = 365,
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

        $period = [
            'startAt' => Carbon::today()
                ->subDays($this->period - 1)
                ->startOfDay(),
            "endAt" => Carbon::today()
                ->endOfDay(),
        ];
        $total = $this->total($period);

        if(key_exists('value',$total)) {
            $value = $total['value'];
        }else{
            $value = $total[0]['y'];
        }

        if(key_exists('change',$total)) {
            $indicator = $this->indicator($total['change'], $value);
        }else{
            $indicator = 0;
        }

        if ($this->format == 'integer') {
            $total = number_format($value,0);
        }

        if ($this->format == 'time') {
            $total = $value/6000;
            $time = explode('.',number_format($total,2));
            $total = date('i \m\i\n s \s', mktime(0, $time[0], $time[1], 1, 1, 2017));
        }

        if ($this->format == 'seconds') {
            $total = ($value <= 0) ? '< 1 s' : round($value, 2) . ' s';
            $indicator = 0;
        }

        $view['label'] = $this->label;
        $view['total'] = $total;
        $view['indicator'] = $indicator;

        return view('agenciafmd/analytics::livewire.card', $view);
    }

    protected function total(Array $period)
    {
        $metrics = explode(':',$this->metrics);
        if($metrics[0] == 'pageviews'){
            $period = array_merge($period,['unit' => 'year']);
        }
        return Umami::query(config('analytics.site_id'),$metrics[0],$period,true)[$metrics[1]];
    }

    private function indicator($totalPast, $total)
    {
        if ($total > 0) {
            return number_format((1 - $totalPast / $total) * 100,0) . '%';
        }
        return $totalPast;
    }
}
