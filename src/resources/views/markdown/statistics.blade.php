@component('agenciafmd/admix::markdown/message')
<?php
    $level = ($level) ?? 'default';
    $introLines = ($introLines) ?? [];
?>
# {{ $greeting }}

@foreach ($introLines as $line)
{{ $line }}

@endforeach

&nbsp;

Páginas mais acessadas
@component('mail::table')
| Página | Visual. | Tempo |
|:------ |:-------------:|:---------------:|
@foreach($analytics as $data)
| {!! $data->pagePath !!} | {{ $data->pageViews }} | {{ $data->avgTimeOnPage }} |
@endforeach
@endcomponent


Entrada dos acessos
@component('mail::table')
| Fonte | Visual. | Únicos |
|:----- |:-------------:|:---------------:|
@foreach($medium as $data)
| {!! ucfirst($data->medium) !!} | {{ $data->pageViews }} | {{ $data->sessions }} |
@endforeach
@endcomponent


Comparativo de visualizações entre os períodos

&nbsp;

![Comparativo entre as semanas](https://image-charts.com/chart?cht=bvg&chxt=x,y&chco=E74C3C,3869D4&chls=2|2&chdl=anterior|atual&chdlp=b&chd=a:{{ $statistics }}&chxl=0:||&chs=500x200)

@endcomponent
