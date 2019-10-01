@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.charts.default', [
    'label' => 'Sessões',
    'data' => $analytics->generic('ga:sessions')['rows']->implode('visitors', ', '),
    'labels' => $analytics->generic('ga:sessions')['rows']->map(function ($row) {
                        return [
                            'date' => (string) $row['date']->locale('en')->isoFormat('D MMM YYYY')
                        ];
                    })->implode('date', "\", \""),
    'format' => ''
])

