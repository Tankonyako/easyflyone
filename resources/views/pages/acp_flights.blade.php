@php($user = \App\Http\Controllers\AuthController::getCurrentUser())
@extends('layouts.acp')
@section('title', 'Admin Panel')
@section('acp_content')
    <h2>Manage New Flight:</h2>
    <hr>

    <div class="row justify-content-center">
        @foreach($newFlights as $newFlight)
            @include('includes.new_flight', ['newFlight' => $newFlight])
        @endforeach
    </div>

    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Flight</h5>
    </div>

    <form method="POST" action="/acp/add/new_flights">
        @csrf
        <div class="modal-body w-100">
            <div class="m-1 e-select-black mw-100">
                <p class="m-0 mb-1"><span class="cil-house"></span> Origin: </p>
                <select class="e-select-advanced e-select form-control" placeholder="Write airport name" name="originIata">
                    @include('includes.airlines', ['default' => 'VNO'])
                </select>
            </div>
            <div class="m-1 e-select-black mw-100">
                <p class="m-0 mt-2 mb-1"><span class="cil-map"></span> Destination: </p>
                <select class="e-select-advanced e-select form-control" placeholder="Write airport name" name="destinationIata">
                    @include('includes.airlines', ['default' => 'LAX'])
                </select>
            </div>
            <hr>
            <div class="m-1">
                <label class="mb-1">Image (Optional):</label>
                <input class="form-control e-input-black" type="text" placeholder="Image URL (Optional)" name="image">
            </div>
            <div class="m-1">
                <label class="mb-1">Name:</label>
                <input class="form-control e-input-black" type="text" placeholder="Name" name="name">
            </div>
            <div class="m-1">
                <label class="mb-1">Price:</label>
                <input class="form-control e-input-black" type="text" placeholder="Price in EUR" name="price">
            </div>
            <div class="m-1">
                <label class="mb-1">Description (Optional):</label>
                <input class="form-control e-input-black" type="text" placeholder="Description (Optional)" name="description">
            </div>
            @include('includes.errors')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
@stop

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/app/acp_new_flights.js') }}"></script>

    @if ($errors->any())
        <script>$(document).ready(function() { onNewFlightClick() })</script>
    @endif
@endpush
