@extends('layouts.default')
@section('title', 'All News')
@section('content')
    <div class="e-main-news mt-3">
        @include('includes.news', ['limit' => 1000, 'showmore' => false, 'horizontal' => true])
    </div>
@stop
