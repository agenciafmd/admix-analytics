<?php

namespace Agenciafmd\Analytics\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;
use Umami\Umami;

class MostViewed extends Component
{
    public string $metrics;

    public string $period;

    public int $quantity;

    public bool $readyToLoad = false;

    public function loadComponent()
    {
        $this->readyToLoad = true;
    }

    public function mount(
        $metrics = 'metrics:url',
        $period = 30,
        $quantity = 10
    )
    {
        $this->metrics = $metrics;
        $this->period = $period;
        $this->quantity = $quantity;
    }

    public function render()
    {
        if (!$this->readyToLoad) {
            for ($i = 0; $i <= $this->quantity; $i++) {
                $rows[] = [
                    'page' => 'Carregando...',
                    'sessions' => 0,
                    'percent' => 0,
                ];
            }

            $view['rows'] = collect($rows);
            $view['total'] = 0;

            return view('agenciafmd/analytics::livewire.most-viewed', $view);
        }

        $period = [
            'startAt' => Carbon::today()
                ->subDays($this->period - 1)
                ->startOfDay(),
            "endAt" => Carbon::today()
                ->endOfDay(),
        ];

        $dimensions = $this->topDimensions($period);

        $view['rows'] = $dimensions['rows'];
        $view['total'] = $dimensions['total'];
        return view('agenciafmd/analytics::livewire.most-viewed', $view);
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
                    'page' => ($dataRow['x']) ? $dataRow['x'] : '(Desconhecido)',
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
