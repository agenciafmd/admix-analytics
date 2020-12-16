<?php

namespace Agenciafmd\Analytics\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Str;

class Chart extends Component
{
    public string $label;

    public string $metrics;

    public string $period;

    public string $dimensions = "ga:date";

    /*
     * TODO: deixar esse cara assíncrono em algum momento
     * https://chasingcode.dev/blog/laravel-livewire-dynamic-charts-apexcharts/
     */
    public bool $readyToLoad = true;

    public function loadComponent()
    {
        $this->readyToLoad = true;
    }

    public function mount(
        $label = 'Visualizações',
        $metrics = 'ga:pageViews',
        $period = 7
    )
    {
        $this->label = $label;
        $this->metrics = $metrics;
        $this->period = $period;
    }

    public function render()
    {
//        if (!$this->readyToLoad) {
//            for ($i = ($this->period - 1); $i >= 0; $i--) {
//                $labels[] = Carbon::yesterday()
//                    ->subDays($i)
//                    ->locale('en')
//                    ->isoFormat('D MMM YYYY');
//                $values[] = 0;
//            }
//
//            $view['label'] = $this->label;
//            $view['values'] = collect($values)->implode(', ');
//            $view['labels'] = collect($labels)->implode('", "');
//
//            return view('agenciafmd/analytics::livewire.chart', $view);
//        }

        //de 7 dias atrás até ontem
        $period = Period::create(
            Carbon::yesterday()
                ->subDays($this->period - 1)
                ->startOfDay(),
            Carbon::yesterday()
                ->endOfDay()
        );

        $results = $this->results($period);

        $view['label'] = $this->label;
        $view['labels'] = $results->pluck('label')
            ->implode('", "');
        $view['values'] = $results->pluck('value')
            ->implode(', ');

        return view('agenciafmd/analytics::livewire.chart', $view);
    }

    protected function results(Period $period)
    {
        $response = Analytics::performQuery($period, $this->metrics, [
            'dimensions' => $this->dimensions,
        ]);

        return collect($response['rows'] ?? [])->map(function (array $row) {
            return [
                'label' => Carbon::createFromFormat('Ymd', $row[0])
                    ->locale('en')
                    ->isoFormat('D MMM YYYY'),
                'value' => (int)$row[1],
            ];
        });
    }
}
