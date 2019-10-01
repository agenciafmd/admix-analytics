@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.bars.default', [
    'label' => 'Sistema Operacional',
    'total' => $analytics->topDimensions('ga:operatingSystem')['totalForAllResults'],
    'data' => $analytics->topDimensions('ga:operatingSystem')['rows'],
    'key' => 'dimensions',
    'value' => 'sessions'
    ])