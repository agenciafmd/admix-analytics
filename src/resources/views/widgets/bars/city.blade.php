@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.bars.default', [
    'label' => 'Cidade',
    'total' => $analytics->topDimensions('ga:city')['totalForAllResults'],
    'data' => $analytics->topDimensions('ga:city')['rows'],
    'key' => 'dimensions',
    'value' => 'sessions'
    ])