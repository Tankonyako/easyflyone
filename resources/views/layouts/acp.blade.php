@extends('layouts.default')
@section('title', 'Admin Panel')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="bg-white e-round p-3">
                <h3 class="mt-0 text-primary"><span class="cil-airplane-mode mr-2"></span>Admin Panel:</h3>
                <ul class="list-group list-group-accent">
                    @include('includes.acp_button', ['type' => 'dashboard', 'text' => 'Dashboard', 'page' => $page])
                    <hr class="mb-1 mt-1">
                    @include('includes.acp_button', ['type' => 'new_news', 'text' => 'News', 'page' => $page])
                    @include('includes.acp_button', ['type' => 'new_flights', 'text' => 'New Flights', 'page' => $page])
                    <hr class="mb-1 mt-1">
                    @include('includes.acp_button', ['type' => 'users', 'text' => 'Users', 'page' => $page])
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="p-2 pl-4 pr-4 e-round bg-white">
                @yield('acp_content')
            </div>
        </div>
    </div>
@stop


