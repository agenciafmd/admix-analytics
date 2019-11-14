@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@if($analytics->generic('ga:goalCompletionsAll')['totalForAllResults'] <= 0)
    <div class="card">
        <div class="text-right invisible">
            <i class="icon fe-chevron-up"></i>
        </div>
        <div class="card-body p-3 text-center">
            <div class="h1 m-0">0</div>
            <div class="text-muted mb-4">Conversões</div>
        </div>
    </div>

@else
    @include('agenciafmd/analytics::widgets.cards.default', [
        'label' => 'Conversões',
        'total' => human_number($analytics->generic('ga:goalCompletionsAll')['totalForAllResults']),
        'indicator' => ($analytics->generic('ga:goalCompletionsAll')['totalForAllResults'] > 0) ? human_number((1 - $analytics->generic('ga:goalCompletionsAll')['totalForAllResultsBefore'] / $analytics->generic('ga:goalCompletionsAll')['totalForAllResults']) * 100) . '%' : $analytics->generic('ga:goalCompletionsAll')['totalForAllResultsBefore'].'%',
    ])
@endif
