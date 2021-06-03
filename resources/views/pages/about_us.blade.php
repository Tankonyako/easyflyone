@extends('layouts.default')
@section('title', 'Privacy Policy')
@section('content')
    <div class="mt-3 e-about-us e-round e-sh-1 p-5">
        <style>
            .e-app
            {
                background-image: url('{{ asset('img/bg.png') }}');
                background-size: contain;
                background-repeat: no-repeat;
                background-position-y: 60px;
            }
        </style>

        <div id="aa-content-frame" class="aa-content-base">
            <h1>EasyFly.One Airlines Group</h1>

            <p>
                We are EasyFly.One Airlines Company that was created during writing Bachelor thesis for completing 4 year studies of Engineering Informatics. Firsly, topic was choosen purely to pass studies, but when research was started we have found English-Russian company that needs airlines for private and commercial purposes, so we contacted them to gather requirements, in addition they give us an idea to create a project based on that other companies can create forks to their needs, and here we are!
            </p>
            <p>At this moment we have 2 offices located In UK and Russia, one more will be located in Czech Republic</p>

        </div>
    </div>
@stop
