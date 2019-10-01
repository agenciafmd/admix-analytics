<div class="chart-sm" id="chart-{{ Str::slug($label) }}"></div>

@push('scripts')
    <script>
        var options = {
            colors:[
                window.tabler.colors.blue,
                window.tabler.colors.red,
                window.tabler.colors.orange,
            ],
            chart: {
                height: 350,
                type: 'area',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
                locales: [{
                    "name": "pt-br",
                    "options": {
                        "months": ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                        "shortMonths": ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                        "days": ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
                        "shortDays": ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
                        "toolbar": {
                            "exportToSVG": "Baixar SVG",
                            "exportToPNG": "Baixar PNG",
                            "menu": "Menu",
                            "selection": "Selecionar",
                            "selectionZoom": "Selecionar Zoom",
                            "zoomIn": "Aumentar",
                            "zoomOut": "Diminuir",
                            "pan": "Navegação",
                            "reset": "Reiniciar Zoom"
                        }
                    }
                }],
                defaultLocale: "pt-br"
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight',
                width: 2,
            },
            series: [{
                name: "Visualização de Páginas",
                data: [{{ $data }}]
            }],
            labels: [
                "{!! $labels !!}"
            ],
            xaxis: {
                type: 'datetime',
            },
            yaxis: {
                opposite: true
            },
            legend: {
                horizontalAlign: 'left'
            },
        };

        var chart = new ApexCharts(
            document.querySelector("#chart-{{ Str::slug($label) }}"),
            options
        );

        chart.render();
    </script>
@endpush