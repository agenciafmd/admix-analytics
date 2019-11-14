@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.cards.default', [
    'label' => 'Duração Média dos Acessos',
    'total' => date('i \m\i\n s \s', mktime(0, 0, $analytics->generic('ga:avgSessionDuration')['totalForAllResults'], 1, 1, 2017)),
    'indicator' => ($analytics->generic('ga:avgSessionDuration')['totalForAllResults'] > 0) ? human_number((1 - $analytics->generic('ga:avgSessionDuration')['totalForAllResultsBefore'] / $analytics->generic('ga:avgSessionDuration')['totalForAllResults']) * 100) . '%' : human_number((1 - $analytics->generic('ga:avgSessionDuration')['totalForAllResultsBefore'] / 1) * 100) . '%',
])