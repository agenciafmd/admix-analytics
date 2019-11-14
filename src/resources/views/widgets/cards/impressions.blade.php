@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.cards.default', [
    'label' => 'Impressões',
    'total' => human_number($analytics->generic('ga:impressions')['totalForAllResults']),
    'indicator' => ($analytics->generic('ga:impressions')['totalForAllResults'] > 0) ? human_number((1 - $analytics->generic('ga:impressions')['totalForAllResultsBefore'] / $analytics->generic('ga:impressions')['totalForAllResults']) * 100) . '%' : human_number((1 - $analytics->generic('ga:impressions')['totalForAllResultsBefore'] / 1) * 100) . '%',
])