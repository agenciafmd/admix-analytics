@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.cards.default', [
    'label' => 'Usuários',
    'total' => human_number($analytics->generic('ga:users')['totalForAllResults']),
    'indicator' => ($analytics->generic('ga:users')['totalForAllResults'] > 0) ? human_number((1 - $analytics->generic('ga:users')['totalForAllResultsBefore'] / $analytics->generic('ga:users')['totalForAllResults']) * 100) . '%' : $analytics->generic('ga:users')['totalForAllResultsBefore'].'%',
])
