@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.bars.default', [
    'label' => 'Resolução de Tela',
    'total' => $analytics->topDimensions('ga:screenResolution')['totalForAllResults'],
    'data' => $analytics->topDimensions('ga:screenResolution')['rows'],
    'key' => 'dimensions',
    'value' => 'sessions'
    ])