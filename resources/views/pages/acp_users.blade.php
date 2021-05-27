@php($user = \App\Http\Controllers\AuthController::getCurrentUser())
@extends('layouts.acp')
@section('title', 'Admin Panel')
@section('acp_content')
    <h2>Manage users</h2>
    <hr>
    <p class="m-0 mb-1"><span class="cil-user-female"></span> Select user: </p>
    <div class="e-select-black">
        <select class="e-select-advanced e-select form-control" placeholder="Write user firstname, lastname, email, phone" name="user_finder" id="__e_UserFinder">
            @foreach($users as $user)
                <option value="{{ $user->id }}">ID: {{ $user->id }} | {{ $user->getFullName() }} - {{ $user->contactEmail }} - {{ $user->contactPhoneNumber }} @if($user->blocked) <span class="text-danger"> - Blocked</span> @endif</option>
            @endforeach
        </select>
    </div>
    <a class="btn btn-outline-secondary mt-2" id="__e_FindUser">Find user</a>
@stop

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/app/acp_users.js') }}"></script>
@endpush
