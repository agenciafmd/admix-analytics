@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.bars.default', [
    'label' => 'Dispositivos',
    'total' => $analytics->topDimensions('ga:deviceCategory')['totalForAllResults'],
    'data' => $analytics->topDimensions('ga:deviceCategory')['rows'],
    'key' => 'dimensions',
    'value' => 'sessions'
    ])