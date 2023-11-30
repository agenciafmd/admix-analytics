<?php

namespace Agenciafmd\Analytics\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;
use Umami\Umami;

class Chart extends Component
{
    public string $label;

    public string $label2;

    public string $metrics;

    public string $period;

    public string $dimensions = "ga:date";

    public bool $readyToLoad = true;

    public function loadComponent()
    {
        $this->readyToLoad = true;
    }

    public function mount(
        $label = 'Visualizações',
        $label2 = 'Vistiantes',
        $metrics = 'ga:pageViews',
        $period = 30
    )
    {
        $this->label = $label;
        $this->label2 = $label2;
        $this->metrics = $metrics;
        $this->period = $period;
    }

    public function render()
    {
        $period = [
            'startAt' => Carbon::today()
                ->subDays($this->period - 1)
                ->startOfDay(),
            "endAt" => Carbon::today()
                ->endOfDay(),
        ];
        $results = $this->results($period,'pageviews');
        $results2 = $this->results($period,'sessions');
        $view['label'] = $this->label;
        $view['label2'] = $this->label2;
        $view['labels'] = $results->pluck('label')
            ->implode('", "');
        $view['values'] = $results->pluck('value')
            ->implode(', ');
        $view['labels2'] = $results2->pluck('label')
            ->implode('", "');
        $view['values2'] = $results2->pluck('value')
            ->implode(', ');

        return view('agenciafmd/analytics::livewire.chart', $view);
    }

    protected function results(Array $period, string $type)
    {
        $response = Umami::query(config('analytics.site_id'),'pageviews',
            $period,true);

        return collect($response[$type] ?? [])->sort()->map(function (array $row) {
            return [
                'label' => Carbon::createFromFormat('Y-m-d', $row['x'])
                    ->locale('en')
                    ->isoFormat('D MMM YYYY'),
                'value' => (int)$row['y'],
            ];
        });
    }
}
