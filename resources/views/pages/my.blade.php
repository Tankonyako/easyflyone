@php($user = \App\Http\Controllers\AuthController::getCurrentUser())
@extends('layouts.default')
@section('title', 'Profile - ' . $user->getFullName())
@section('content')
    <div class="row mt-5">
        <div class="col-md-2">
            <img class="w-100 rounded" src="{{ $user->getAvatar() }}">
        </div>
        <div class="col-md bg-white rounded p-3 pl-4 pr-4">
            <h3>{{ $user->getFullName() }}</h3>
            <hr>
            <div class="row">
                <div class="col-md-3 border-right">
                    <ul class="nav flex-column">
                        <li>
                            <h4 class="ml-3">My account</h4>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/my"><span class="cil-list-filter"></span> Basic information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/my/changepassword"><span class="cil-lock-unlocked"></span> Change password</a>
                        </li>
                        <li>
                            <h4 class="ml-3 mb-1 mt-1">My trips</h4>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/my/tickets"><span class="cil-airplane-mode"></span> Tickets</a>
                        </li>
                        <li class="nav-item">
                            <hr>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('logout') }}"><span class="cil-account-logout"></span> Log Out</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md">
                    @if($type == 'my')
                        <h3><span class="cil-list-filter"></span> Basic information</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md">
                                <h5>Account information: </h5>
                                <p class="mb-0 mt-1">Full name: <b>{{ $user->getFullName() }}</b></p>
                                <p class="mb-0 mt-1">Contact language: <b>{{ $user->contactLanguage }}</b></p>
                                <p class="mb-0 mt-1">Contact EMail: <b>{{ $user->getSecuredEmail() }}</b></p>
                                <p class="mb-0 mt-1">Contact phone: <b>{{ substr($user->contactPhoneNumber, 0, strlen($user->contactPhoneNumber) / 2) }}*******</b></p>
                                <p class="mb-0 mt-1">Registered at: <b>{{ $user->created_at }}</b></p>
                            </div>
                            <div class="col-md">
                                <h5>Passport information: </h5>
                                <p class="mb-0 mt-1">Passport country: <b>{{ $user->passportCountry }}</b></p>
                                <p class="mb-0 mt-1">Passport ID: <b>{{ substr($user->passportId, 0, strlen($user->passportId) / 2) }}*******</b></p>
                                <p class="mb-0 mt-1">Passport expire date: <b>{{ $user->passportPeriod }}</b></p>
                            </div>
                        </div>

                    @elseif($type == 'changepassword')
                        <h3><span class="cil-lock-unlocked"></span> Change password</h3>
                        <hr>

                        <form method="POST" action="/cp/changepassword">
                            @csrf

                            <div class="row">
                                <div class="m-1 col-md-4 pr-0">
                                    <label class="mb-1">Old password:</label>
                                    <input class="form-control e-input-black" type="password" placeholder="qwerty" name="password_old">
                                </div>
                            </div>
                            <div class="row">
                                <div class="m-1 pr-0 col-md-4">
                                    <label class="mb-1">New password:</label>
                                    <input class="form-control e-input-black" type="password" placeholder="qwerty" name="password">
                                </div>
                                <div class="m-1 pl-0 pr-0 col-md-4">
                                    <label class="mb-1">Confirm password:</label>
                                    <input class="form-control e-input-black" type="password" placeholder="qwerty" name="password_confirmation">
                                </div>
                                <div class="m-0 col-md-8">
                                    @include('includes.errors')
                                </div>
                            </div>
                            <div class="m-1">
                                <p class="text-muted mb-0">When you change your password, you will be logged out of your account.</p>
                                <button type="submit" class="btn btn-info btn-sm mt-1 mx-auto"><span class="cil-lock-locked"></span> Change password</button>
                            </div>
                        </form>

                    @elseif($type == 'tickets')
                        <h3><span class="cil-airplane-mode"></span> Tickets</h3>
                        <hr>
                        @if(count($user->getTickets()) == 0)
                            <h3><span class="cil-book"></span> Tickets not found!</h3>
                        @else
                            <div class="row justify-content-center">
                                @foreach($user->getTickets() as $ticket)
                                    @include('includes.ticket_preview', ['ticket' => $ticket])
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
