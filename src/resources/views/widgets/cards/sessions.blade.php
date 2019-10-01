@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.cards.default', [
    'label' => 'Acessos',
    'total' => human_number($analytics->generic('ga:sessions')['totalForAllResults']),
    'indicator' => human_number((1 - $analytics->generic('ga:sessions')['totalForAllResultsBefore'] / $analytics->generic('ga:sessions')['totalForAllResults']) * 100) . '%',
])