@extends('agenciafmd/admix::master')

@section('content')
    <div class="row">
        <!-- http://screencloud.net/v/DN2ov -->
        <div class="col-sm-6 col-md-3">
            @include('agenciafmd/analytics::widgets.cards.sessions')
        </div>
        <div class="col-sm-6 col-md-3">
            @include('agenciafmd/analytics::widgets.cards.users')
        </div>
        <div class="col-sm-6 col-md-3">
            @include('agenciafmd/analytics::widgets.cards.new-users')
        </div>
        <div class="col-sm-6 col-md-3">
            @include('agenciafmd/analytics::widgets.cards.organic-searches')
        </div>
        <div class="col-sm-6 col-md-3">
            @include('agenciafmd/analytics::widgets.cards.bounce-rate')
        </div>
        <div class="col-sm-6 col-md-3">
            @include('agenciafmd/analytics::widgets.cards.avg-session-duration')
        </div>
        <div class="col-sm-6 col-md-3">
            @include('agenciafmd/analytics::widgets.cards.impressions')
        </div>
        <div class="col-sm-6 col-md-3">
            @include('agenciafmd/analytics::widgets.cards.goal-completions-all')
        </div>
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
                        <div class="col-sm-12 col-lg-3">
                            @include('agenciafmd/analytics::widgets.bars.city')
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            @include('agenciafmd/analytics::widgets.bars.browser')
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            @include('agenciafmd/analytics::widgets.bars.screen-resolution')
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            @include('agenciafmd/analytics::widgets.bars.device-category')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.8.6/apexcharts.min.js"></script>
@endpush