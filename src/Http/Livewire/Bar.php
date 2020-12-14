<?php

namespace Agenciafmd\Analytics\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class Bar extends Component
{
    public string $label;

    public string $metrics;

    public string $period;

    public string $dimensions;

    public int $quantity;

    public bool $readyToLoad = false;

    public function loadComponent()
    {
        $this->readyToLoad = true;
    }

    public function mount(
        $label = 'Cidades',
        $dimensions = 'ga:city',
        $metrics = 'ga:sessions',
        $period = 7,
        $quantity = 5
    )
    {
        $this->label = $label;
        $this->dimensions = $dimensions;
        $this->metrics = $metrics;
        $this->period = $period;
        $this->quantity = $quantity;
    }

    public function render()
    {
        if (!$this->readyToLoad) {
            for ($i = 0; $i <= $this->quantity; $i++) {
                $rows[] = [
                    'dimensions' => 'Carregando...',
                    'sessions' => 0,
                    'percent' => 0,
                ];
            }

            $view['label'] = $this->label;
            $view['total'] = 0;
            $view['rows'] = collect($rows);

            return view('agenciafmd/analytics::livewire.bar', $view);
        }

        //de 7 dias atrás até ontem
        $period = Period::create(
            Carbon::yesterday()
                ->subDays($this->period - 1)
                ->startOfDay(),
            Carbon::yesterday()
                ->endOfDay()
        );

        $dimensions = $this->topDimensions($period);

        $view['label'] = $this->label;
        $view['total'] = $dimensions['total'];
        $view['rows'] = $dimensions['rows'];

        return view('agenciafmd/analytics::livewire.bar', $view);
    }

    protected function topDimensions(Period $period)
    {
        $response = Analytics::performQuery($period, $this->metrics, [
                'dimensions' => $this->dimensions,
                'sort' => "-{$this->metrics}",
                'filters' => "{$this->dimensions}!=(not set)",
                'max-results' => $this->quantity,
            ]
        );

        $total = $response->totalsForAllResults[$this->metrics];

        $rows = collect($response['rows'] ?? [])
            ->map(function (array $dataRow) use ($total) {
                return [
                    'dimensions' => $dataRow[0],
                    'sessions' => (int)$dataRow[1],
                    'percent' => round(((int)$dataRow[1] / $total) * 100, 2),
                ];
            })
            ->splice(0, $this->quantity);

        return collect([
            'total' => $total,
            'rows' => $rows,
        ]);
    }
}
