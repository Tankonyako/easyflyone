@php($user = \App\Http\Controllers\AuthController::getCurrentUser())
@extends('layouts.acp')
@section('title', 'Admin Panel')
@section('acp_content')
    <h2><a class="" href="{{ route('acp_users') }}"><span class="cil-backspace btn btn-outline-dark mr-3"></span></a>
        Manage user - #{{ $foundedUser->id }} - {{ $foundedUser->getFullName() }}
        @if($foundedUser->blocked) <span class="text-danger">Blocked</span> @endif</h2>
    <hr>
    <div class="row">
        <div class="col-md-2 border-right">
            <img src="{{ $foundedUser->getAvatar() }}" class="w-100">
        </div>
        <div class="col-md">
            <h2>{{ $foundedUser->getFullName() }}</h2>
            <h3 class="mb-0 mt-1">Contact info:</h3>
            <div class="row">
                <div class="col-md">
                    <p class="mb-0">Contact phone: <b>{{ $foundedUser->contactPhoneNumber }}</b></p>
                    <p class="mb-0">Contact gender: <b>{{ $foundedUser->gender == 0 ? 'Male' : 'Female' }}</b></p>
                </div>
                <div class="col-md">
                    <p class="mb-0">Contact language: <b>{{ $foundedUser->contactLanguage }}</b></p>
                </div>
            </div>
            <p class="mb-0">Contact EMail: <b>{{ $foundedUser->contactEmail }}</b></p>
            <h3 class="mb-0 mt-2">Address info:</h3>
            <div class="row">
                <div class="col-md">
                    <p class="mb-0">Country: <b>{{ $foundedUser->addressCountry }}</b></p>
                    <p class="mb-0">City: <b>{{ $foundedUser->addressCity }}</b></p>
                </div>
                <div class="col-md">
                    <p class="mb-0">Post Code: <b>{{ $foundedUser->addressPostCode }}</b></p>
                </div>
            </div>
            <p class="mb-0">Detailed: <b>{{ $foundedUser->addressDetail }}</b></p>
            <h3 class="mb-0 mt-2">Passport info:</h3>
            <div class="row">
                <div class="col-md">
                    <p class="mb-0">Passport country: <b>{{ $foundedUser->passportCountry }}</b></p>
                </div>
                <div class="col-md">
                    <p class="mb-0">Passport ID: <b>{{ $foundedUser->passportId }}</b></p>
                </div>
            </div>
            <p class="mb-0">Passport Expire Date: <b>{{ $foundedUser->passportPeriod }}</b></p>
            <hr>
            <h3 class="mb-0 mb-2">Actions:</h3>
            @if(!$foundedUser->isAdmin())
                <div class="d-flex">
                    <form method="POST" action="/acp/toggleblacklist/user">
                        @csrf
                        <input type="hidden" name="id" value="{{ $foundedUser->id }}">
                        <button type="submit" class="btn btn-outline-danger mr-2">@if($foundedUser->blocked) Remove from @else Add to @endif blacklist</button>
                    </form>
                    <form method="POST" action="/acp/remove/user">
                        @csrf
                        <input type="hidden" name="id" value="{{ $foundedUser->id }}">
                        <button type="submit" class="btn btn-danger">Remove user</button>
                    </form>
                </div>
            <hr>
            @endif
            <h3 class="mb-0 mb-2">Tickets:</h3>
            @if(count($user->getTickets()) == 0)
                <h3><span class="cil-book"></span> Tickets not found!</h3>
            @else
                <div class="row justify-content-center">
                    @foreach($user->getTickets() as $ticket)
                        @include('includes.ticket_preview', ['ticket' => $ticket])
                    @endforeach
                </div>
            @endif
        </div>
    </div>

@stop

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/app/acp_user.js') }}"></script>
@endpush
