@extends('layouts.default')
@section('title', 'Home')
@section('content')
    <div class="e-home-tickets mt-3">
        @include('includes.tickets')
    </div>

    <div class="mt-3 mb-3 e-sh-1 e-round pb-3 pt-3 e-new-flights bg-light wow fadeInRightBig">
        <h1 class="text-center">New Flights</h1>
        <hr>
        <div class="row justify-content-center">
            @foreach(\App\Models\NewFlight::all() as $newFlight)
                @include('includes.new_flight', ['newFlight' => $newFlight])
            @endforeach
        </div>
    </div>

    <div class="e-home-news mt-3 e-sh-1 e-round">
        @include('includes.news', ['limit' => 3, 'showmore' => true, 'horizontal' => false, 'min' => false])
    </div>

    <div class="e-discord-info pt-5 pt-md-0 e-sh-1 p-5 p-md-3 mt-3 wow fadeInRightBig">
        <div class="row">
            <div class="col-md-4 d-flex e-discord-logo-box">
                <span class="cib-discord text-white text-right m-auto"></span>
            </div>
            <div class="col-md text-light mt-5 mb-5 border-left">
                <h1 class="text-white">Join our Discord server!</h1>
                <h4 class="font-weight-light">You can join our Discord server, and loot <span class="badge badge-warning">5% discount</span> on all booking!</h4>

                <a class="btn btn-outline-light mt-2" href="{{ config('app.discord') }}" target="_blank"> Join our Discord Server</a>
            </div>
        </div>
    </div>
@stop

@push('scripts')

@endpush
