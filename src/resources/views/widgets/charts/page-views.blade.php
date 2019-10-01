@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.charts.default', [
    'label' => 'Visualizações',
    'data' => [$analytics->generic('ga:pageViews')['rows']->implode('sessions', ', ')],
    'labels' => ["'" . $analytics->generic('ga:pageViews')['rows']->map(function ($row) {
        return [
            'date' => (string) $row['date']->format('d/m')
            ];
    })->implode('date', "', '") . "'"],
    'format' => ''
    ])