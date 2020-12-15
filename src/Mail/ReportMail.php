<?php

namespace Agenciafmd\Analytics\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Carbon;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class ReportMail extends Mailable
{
    protected $notifiable;

    /* number of days before yesterday */
    protected int $days = 7;

    public function __construct($notifiable)
    {
        $this->notifiable = $notifiable;
    }

    public function build()
    {
        $period = Period::create(
            Carbon::yesterday()
                ->subDays($this->days - 1)
                ->startOfDay(),
            Carbon::yesterday()
                ->endOfDay()
        );

        $view['initialDate'] = $period->startDate;
        $view['finalDate'] = $period->endDate;
        $view['sessions'] = $this->total('ga:sessions', $period);
        $view['newUsers'] = $this->total('ga:newUsers', $period);
        $view['organicSearches'] = $this->total('ga:organicSearches', $period);

        $filter = "ga:pageTitle!=(not set)";
        $view['topPages'] = $this->topDimensions('ga:pageViews', 'ga:pagePath', $period, $filter);

        $filter = "ga:keyword!=(none);ga:keyword!=(not set);ga:keyword!=(not provided);ga:keyword!=(automatic matching)";
        $view['topKeywords'] = $this->topDimensions('ga:pageViews', 'ga:keyword', $period, $filter);

        $filter = "ga:source!=(none);ga:source!=(not set)";
        $view['topSource'] = $this->topDimensions('ga:pageViews', 'ga:source', $period, $filter);

        $filter = "ga:medium!=(none);ga:medium!=(not set)";
        $view['topMedium'] = $this->topDimensions('ga:pageViews', 'ga:medium', $period, $filter);

        $filter = "ga:deviceCategory!=(none);ga:deviceCategory!=(not set)";
        $view['topDeviceCategory'] = $this->topDimensions('ga:pageViews', 'ga:deviceCategory', $period, $filter);

        $filter = "ga:city!=(none);ga:city!=(not set)";
        $view['topCities'] = $this->topDimensions('ga:pageViews', 'ga:city', $period, $filter);

        $filter = "ga:userAgeBracket!=(none);ga:userAgeBracket!=(not set)";
        $view['topAges'] = $this->topDimensions('ga:pageViews', 'ga:userAgeBracket', $period, $filter)
            ->sortBy('dimensions');

        $filter = "ga:userGender!=(none);ga:userGender!=(not set)";
        $topGenders = $this->topDimensions('ga:pageViews', 'ga:userGender', $period, $filter);
        $sumTopGenders = $topGenders->sum('metrics');
        $view['topGenders'] = $topGenders->map(function ($item) use ($sumTopGenders) {
                $genders['female'] = 'Feminino';
                $genders['male'] = 'Masculino';

                return [
                    'dimensions' => ($genders[$item['dimensions']]) ?? ucfirst($item['dimensions']),
                    'metrics' => $item['metrics'],
                    'percent' => round(($item['metrics'] * 100) / $sumTopGenders),
                ];
            });

        return $this->to($this->notifiable->email, $this->notifiable->name)
            ->subject(config('app.name') . ' | Relatório de Semanal')
            ->view('agenciafmd/analytics::email.report')
            ->with($view);
    }

    protected function total(string $metrics, Period $period)
    {
        return human_number(Analytics::performQuery($period, $metrics, [
                'dimensions' => 'ga:date',
            ])->totalsForAllResults[$metrics] ?? 0);
    }

    protected function topDimensions(
        string $metrics,
        string $dimensions,
        Period $period,
        string $filters = '',
        int $quantity = 5
    )
    {
        $response = Analytics::performQuery($period, $metrics, [
                'dimensions' => $dimensions,
                'sort' => "-{$metrics}",
                'max-results' => $quantity,
            ] + (($filters) ? ['filters' => "{$filters}"] : []),
        );

        $total = array_sum(array_column($response['rows'], 1)) ?? 1;

        return collect($response['rows'] ?? [])
            ->map(function (array $row) use ($total){
                return [
                    'dimensions' => $row[0],
                    'metrics' => (int)$row[1],
                    'percent' => round(((int)$row[1] * 100) / $total),
                ];
            })
            ->splice(0, $quantity);
    }

}
