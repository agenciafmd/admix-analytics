@extends('agenciafmd/admix::master')

@section('content')
    <div class="row">

        <livewire:analytics::card label="Acessos" metrics="ga:sessions" />

        <livewire:analytics::card label="Acessos Orgânicos" metrics="ga:organicSearches" />

        <livewire:analytics::card label="Usuários" metrics="ga:users" />

        <livewire:analytics::card label="Novos Usuários" metrics="ga:newUsers" />

        <livewire:analytics::card label="Duração Média dos Acessos" metrics="ga:avgSessionDuration" format="time" />

        <livewire:analytics::card label="Tempo Médio de Carregamento" metrics="ga:avgPageLoadTime" format="seconds" />

        <livewire:analytics::card-lead label="Leads Recebidos" />

        <livewire:analytics::card label="Visualizações de Páginas" metrics="ga:pageviews" />

{{--        <livewire:analytics::card label="Impressões" metrics="ga:impressions" />--}}

{{--        <livewire:analytics::card label="Conversões" metrics="ga:goalCompletionsAll" />--}}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card graph">
                <div class="card-header border-bottom">
                    Como está o trafego do site?
                </div>
                <div class="card-body">
                    @include('agenciafmd/analytics::widgets.charts.sessions')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    Qual o perfil de quem acessa o site?
                </div>
                <div class="card-block">
                    <div class="row">

                        <livewire:analytics::bar label="Cidade" dimensions="ga:city" />

                        <livewire:analytics::bar label="Navegador" dimensions="ga:browser" />

                        <livewire:analytics::bar label="Resolução de Tela" dimensions="ga:screenResolution" />

                        <livewire:analytics::bar label="Dispositivos" dimensions="ga:deviceCategory" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.8.6/apexcharts.min.js"></script>
@endpush