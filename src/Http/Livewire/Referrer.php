<?php

namespace Agenciafmd\Analytics\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;
use Umami\Umami;

class Referrer extends Component
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
        $label = 'Referências',
        $dimensions = '',
        $metrics = 'metrics:referrer',
        $period = 30,
        $quantity = 10
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

            return view('agenciafmd/analytics::livewire.referrer', $view);
        }

        $period = [
            'startAt' => Carbon::today()
                ->subDays($this->period - 1)
                ->startOfDay(),
            "endAt" => Carbon::today()
                ->endOfDay(),
        ];

        $dimensions = $this->topDimensions($period);

        $view['label'] = $this->label;
        $view['total'] = $dimensions['total'];
        $view['rows'] = $dimensions['rows'];

        return view('agenciafmd/analytics::livewire.referrer', $view);
    }

    protected function topDimensions(Array $period)
    {
        $metrics = explode(':',$this->metrics);
        $response = Umami::query(config('analytics.site_id'),$metrics[0],[
            'startAt'=>Carbon::now()->subMonth(),
            'endAt'=>Carbon::now(),
            'type'=>$metrics[1],
        ],true);

        $total = collect($response)->sum('y');
        $rows = collect($response ?? [])
            ->map(function (array $dataRow) use ($total) {
                return [
                    'dimensions' => ($dataRow['x']) ? $dataRow['x'] : '(Desconhecido)',
                    'sessions' => (int)$dataRow['y'],
                    'percent' => round(((int)$dataRow['y'] / $total) * 100, 2),
                ];
            })
            ->splice(0, $this->quantity);

        return collect([
            'total' => $total,
            'rows' => $rows,
        ]);
    }
}
