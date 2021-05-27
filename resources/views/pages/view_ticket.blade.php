@extends('layouts.default')
@if($foundTicket)
    @section('title', 'Ticket - ' . $ticket->uid)
@else
    @section('title', 'Ticket not found!')
@endif
@section('content')
    <div>
        @if($foundTicket)

            <div class="e-ticket e-main-print">
                <div class="row">
                    <div class="col-md-2 e-qr ml-4 pt-3">
                        <img width="100%" class="mb-2" src="{{ asset('img/logo-m.png') }}">
                        {!! QrCode::size(250)->generate($ticket->uid); !!}
                        <hr class="mb-2 mt-3">
                        <p class="text-muted text-center">{{ $ticket->uid }}</p>
                    </div>
                    <div class="col-md">
                        <div class="row e-ticket-header">
                            <div class="col-md-2">
                                <img width="100%" class="mb-2" src="{{ asset('img/logo-m.png') }}">
                            </div>
                            <div class="col-md">
                                <h2 class="mt-2 font-weight-normal">Ticket #{{ $ticket->uid }}</h2>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <h5 class="mb-1">Origin:</h5>
                                <p class="mb-0">Airport: <b>{{ $ticket->getOrigin()->name }} ({{ $ticket->getOrigin()->iata_code }})</b></p>
                                <p class="mb-0">City: <b>{{ $ticket->getOrigin()->city }}</b></p>
                                <p class="mb-0">Country: <b>{{ $ticket->getOrigin()->country }}</b></p>
                            </div>
                            <div class="col-md-3 border-right">
                                <h5 class="mb-1">Destination:</h5>
                                <p class="mb-0">Airport: <b>{{ $ticket->getDestination()->name }} ({{ $ticket->getDestination()->iata_code }})</b></p>
                                <p class="mb-0">City: <b>{{ $ticket->getDestination()->city }}</b></p>
                                <p class="mb-0">Country: <b>{{ $ticket->getDestination()->country }}</b></p>
                            </div>
                            <div class="col-md">
                                <h5 class="mb-1">Dates:</h5>
                                <p class="mb-0">Departure date: <b>{{ $ticket->departureDate }}</b></p>
                                @if($ticket->willReturn)
                                    <p class="mb-0">Return date: <b>{{ $ticket->returnDate }}</b></p>
                                @else
                                    <p class="mb-0">Return date: <b>One-Way</b></p>
                                @endif
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md">
                                <h5 class="mb-1">Flight details:</h5>
                                <p class="mb-0">Distance: <b>{{ number_format(\App\Http\Controllers\StaticDataController::getDistanceBetween(
                                    $ticket->getOrigin()->_geoloc->lat, $ticket->getOrigin()->_geoloc->lng,
                                    $ticket->getDestination()->_geoloc->lat, $ticket->getDestination()->_geoloc->lng), 2, '.', '') }} km</b></p>
                                <p class="mb-0">Average time: <b>{{ date('i:s', number_format(\App\Http\Controllers\StaticDataController::getDistanceBetween(
                                    $ticket->getOrigin()->_geoloc->lat, $ticket->getOrigin()->_geoloc->lng,
                                    $ticket->getDestination()->_geoloc->lat, $ticket->getDestination()->_geoloc->lng) / 10, 2, '.', '')) }}</b></p>

                            </div>
                            <div class="col-md-1 e-qr border-0 ml-auto pr-4">
                                {!! QrCode::size(250)->generate($ticket->uid); !!}
                            </div>
                        </div>

                        <hr>

                        <h5 class="mb-2">Passengers:</h5>
                        <div class="row mb-2">
                            @php($i = 1)
                            @foreach($ticket->getPassengers() as $passenger)
                                <div class="col-md-2 border-right">
                                    <h5 class="font-weight-normal mb-0 text-center">{{ $passenger->firstname }} {{ $passenger->lastname }}</h5>
                                    <p class="mb-0 mt-0 font-1xl text-center">Passenger #{{ $i}}</p>
                                    <p class="mb-0 mt-0 font-1xl text-center">Seat {{ $passenger->getSeatFormatted() }}</p>
                                </div>
                                @php($i++)
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-outline-dark mt-3 no e-not-print" href="#" onclick="window.print();"><span class="cil-print"></span> Print the ticket</a>
            <p class="e-only-print pt-3">
                The content of this paper is confidential and intended for the owner and airlines only. It is strictly forbidden to share any part of this paper with any third party, without a written consent of the owner. If you received this paper by mistake or found it, please send report to support@easyfly.one
            </p>
            <hr class="e-only-print">
        @else
            <div class="d-flex mt-5">
                <div class="m-auto">
                    <h1 class="text-center"><span class="cil-paperclip"></span></h1>
                    <h2 class="text-center">Ticket not found!</h2>
                    <hr>
                    <p>The ticket was not found or was deleted/moved by the administration, you can try again.</p>
                </div>
            </div>
            <div class="d-flex">
                <div class="m-auto">
                    <a class="text-center btn btn-outline-dark" href="{{ route('home') }}"><span class="cil-x"></span> Back</a>
                </div>
            </div>
        @endif
    </div>
@stop
