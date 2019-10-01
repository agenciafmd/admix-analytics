@extends('agenciafmd/admix::master')

@section('content')
    <div class="embed-responsive embed-responsive-16by9" style="margin: 0 0 1.5rem;">
        <iframe class="embed-responsive-item" src="{{ config('analytics.report') }}"></iframe>
    </div>
@endsection