@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.bars.default', [
    'label' => 'Navegador',
    'total' => $analytics->topDimensions('ga:browser')['totalForAllResults'],
    'data' => $analytics->topDimensions('ga:browser')['rows'],
    'key' => 'dimensions',
    'value' => 'sessions'
    ])