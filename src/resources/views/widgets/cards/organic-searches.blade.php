@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@include('agenciafmd/analytics::widgets.cards.default', [
    'label' => 'Acessos Orgânicos',
    'total' => human_number($analytics->generic('ga:organicSearches')['totalForAllResults']),
    'indicator' => ($analytics->generic('ga:organicSearches')['totalForAllResults'] > 0) ? human_number((1 - $analytics->generic('ga:organicSearches')['totalForAllResultsBefore'] / $analytics->generic('ga:organicSearches')['totalForAllResults']) * 100) . '%' : $analytics->generic('ga:organicSearches')['totalForAllResultsBefore'].'%',
])
