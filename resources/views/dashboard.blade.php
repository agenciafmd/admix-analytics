<div class="page-wrapper">
    <x-page.header>
        Dashboard
    </x-page.header>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row" style="padding-top: 20px; padding-left: 20px; padding-right: 20px;">
                    <livewire:analytics::card label="Visualizações de Páginas" metrics="stats:pageviews" />

                    <livewire:analytics::card label="Visitantes" metrics="pageviews:sessions" />

                    {{--<livewire:analytics::card label="Visualizações unicas" metrics="stats:uniques" />--}}

                    <livewire:analytics::card label="Duração Média dos Acessos" metrics="stats:totaltime" format="time" />

                    <livewire:analytics::card-rejection label="Taxa de rejeição" />

                    {{--<livewire:analytics::card-lead label="Leads Recebidos" />--}}
                </div>
                <div class="row">
                    <div class="page-body">
                        <div class="container-xl">
                            <div class="card graph">
                                <div class="card-header border-bottom">
                                    Como está o trafego do site?
                                </div>
                                <div class="card-body">
                                    <livewire:analytics::chart label="Visualizações de Páginas" label2="Visitantes" metrics="pageviews:pageviews" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12" style="padding-left: 20px; padding-right: 20px;">
                        <div class="card">
                            <div class="card-header border-bottom">
                                Páginas mais acessadas
                            </div>
                            <div class="card-body">
                                <livewire:analytics::most-viewed label="Páginas mais acessadas" metrics="metrics:url" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 20px;">
                        <div class="col-md-12 col-lg-8" style="padding-left: 20px;">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    Parametros de busca
                                </div>
                                <div class="card-body">
                                    <livewire:analytics::search-url label="Parametros de busca" metrics="metrics:query" />
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4" style="padding-right: 20px;">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    Referências
                                </div>
                                <div class="card-body">
                                    <livewire:analytics::referrer label="Referência" metrics="metrics:referrer" />
                                </div>
                            </div>
                        </div>
                </div>

                <div class="row">
                    <div class="page-body">
                        <div class="container-xl">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    Qual o perfil de quem acessa o site?
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <livewire:analytics::bar label="Sistema Operacional" metrics="metrics:os" />

                                        <livewire:analytics::bar label="Navegador" metrics="metrics:browser" />

                                        <livewire:analytics::bar label="Dispositivos" metrics="metrics:device" />

                                        <livewire:analytics::bar label="Telas" metrics="metrics:screen" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.8.6/apexcharts.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const list = new List('table-default', {
                sortClass: 'table-sort',
                listClass: 'table-tbody',
                valueNames: [ 'sort-name', 'sort-type', 'sort-city', 'sort-score',
                    { attr: 'data-date', name: 'sort-date' },
                    { attr: 'data-progress', name: 'sort-progress' },
                    'sort-quantity'
                ]
            });
        })

    </script>
@endpush
