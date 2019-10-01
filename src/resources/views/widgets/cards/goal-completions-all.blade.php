@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@if($analytics->generic('ga:goalCompletionsAll')['totalForAllResults'] <= 0)
    <div class="card">
        <div class="card-block pb-0">
            <h4 class="mb-0">0</h4>
            <p>Conversões</p>
        </div>
        <div class="card-block pb-0 pt-0" style="height:70px;">
            <a href="https://fmd.ag/?utm_source={{ config('app.url') }}&utm_campaign=admix&utm_medium=link&utm_term=conversoes"
               target="_blank" class="font-weight-bold">Clique aqui</a> e aumente suas conversões.
        </div>
    </div>
@else
    @include('agenciafmd/analytics::widgets.cards.default', [
        'label' => 'Conversões',
        'total' => human_number($analytics->generic('ga:goalCompletionsAll')['totalForAllResults']),
        'indicator' => human_number((1 - $analytics->generic('ga:goalCompletionsAll')['totalForAllResultsBefore'] / $analytics->generic('ga:goalCompletionsAll')['totalForAllResults']) * 100) . '%',
    ])
@endif