@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.cards.default', [
    'label' => 'Novos Usuários',
    'total' => human_number($analytics->generic('ga:newUsers')['totalForAllResults']),
    'indicator' => human_number((1 - $analytics->generic('ga:newUsers')['totalForAllResultsBefore'] / $analytics->generic('ga:newUsers')['totalForAllResults']) * 100) . '%',
])