@extends('layouts.parent')
@section('parent')

    @include('includes.header')

    <div class="container e-app-content pt-3 pb-3 min-vh-100 d-table pl-0 pr-0 pl-md-3 pr-md-3">
        @yield('content')
    </div>

    @include('includes.footer')
@stop
