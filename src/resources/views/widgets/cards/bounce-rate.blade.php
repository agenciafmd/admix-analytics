@inject('analytics', '\Agenciafmd\Analytics\Services\AnalyticsService')

@php
    $indicator = human_number((1 - $analytics->generic('ga:bounceRate')['totalForAllResultsBefore'] / $analytics->generic('ga:bounceRate')['totalForAllResults']) * 100);
@endphp

<div class="card">
    <div class="card-body p-3 text-center">
        @if(isset($indicator))
            <div class="text-right @if(Str::startsWith($indicator, '-')) text-green @else text-red @endif">
                {{ trim($indicator, '-') }}%
                <i class="icon @if(Str::startsWith($indicator, '-')) fe-chevron-down @else fe-chevron-up @endif"></i>
            </div>
        @endif
        <div class="h1 m-0">{{ number_format($analytics->generic('ga:bounceRate')['totalForAllResults'], 0) }}%</div>
        <div class="text-muted mb-4">Taxa de Rejeição</div>
    </div>
</div>