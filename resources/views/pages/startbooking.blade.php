@extends('layouts.default')
@section('title', 'Booking - ' . $origin_iata_code . '/' . $destination_iata_code)
@section('content')
    @php($hasErrors = $errors->any())
    <div class="e-booking e-sh-0 e-round">
        <div class="e-booking-header pl-5 pr-5 d-flex">
            <h3 class="mr-auto"><span class="cil-airplane-mode"></span> Booking - <span id="__e_BookingState" class="font-weight-normal">@if($hasErrors) Error! @else Loading... @endif</span></h3>

            <a class="ml-auto e-booking-close btn btn-outline-dark my-auto" href="{{ route('home') }}"><span class="cil-backspace"></span> Back to home</a>
        </div>
        <div class="e-booking-content pl-5 pr-5 pt-2">
            @if($hasErrors)
                <div class="alert alert-danger bg-transparent m-0 p-0">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <a class="btn btn-outline-danger" href="#" onclick="window.location.reload()">Try again</a>
                </div>
            @endif
        </div>
    </div>
@stop
<div class="_t_CountriesSelectorPlaceholder" style="display: none">
    <div class="e-select-black">
        <label class="mb-1">Passenger Passport country:</label>
        <select class=" form-control ___id_" placeholder="Where passport from" data-for="___for_" name="passportCountry">
            @foreach(\App\Http\Controllers\StaticDataController::getCountries() as $code => $name)
                <option value="{{ $name }}" {{ ($name == 'Lithuania')?'selected':'' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>

<form class="d-none" method="POST" id="__e_Sender" action="{{ route('ticketsAdd') }}">
    @csrf
    <input type="hidden" name="payload" value="{}">
    <input type="hidden" name="email" value="">
</form>

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/app/booking.js') }}"></script>
    @if(!$hasErrors)
        <script>
            $(document).ready(function() {
                startBooking(`{{ $origin_iata_code }}`, `{{ $destination_iata_code }}`);
            });
        </script>
    @endif
@endpush
