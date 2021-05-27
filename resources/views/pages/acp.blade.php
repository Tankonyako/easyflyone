@php($user = \App\Http\Controllers\AuthController::getCurrentUser())
@extends('layouts.acp')
@section('title', 'Admin Panel')
@section('acp_content')
    <h2>Dashboard</h2>
    <hr>
    <p>The admin panel of the EasyFly.One service.</p>
@stop
