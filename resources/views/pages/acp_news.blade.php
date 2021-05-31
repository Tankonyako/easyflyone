@php($user = \App\Http\Controllers\AuthController::getCurrentUser())
@extends('layouts.acp')
@section('title', 'Admin Panel')
@section('acp_content')
    <h2>Manage news:</h2>
    <hr>

    <div class="w-100 e-main-news">
        <div class="e-news">
            @include('includes.news', ['limit' => 1000, 'showmore' => false, 'horizontal' => false, 'min' => true])
        </div>
    </div>

    <a class="btn btn-outline-secondary mt-2" id="__e_AddNewPost"><span class="cil-note-add"></span> Add new post</a>
@stop

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/app/acp_news.js') }}"></script>

    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    @if ($errors->any())
        <script>$(document).ready(function() { onNewNewsClick() })</script>
    @endif
@endpush

<div class="modal fade" id="addNewPost" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
{{--            TODO:--}}
            <form method="POST" action="/acp/add/post" id="__e_PostForm">
                @csrf
                <div class="modal-body w-100">
                    <div class="m-1">
                        <label class="mb-1">Image (Optional):</label>
                        <input class="form-control e-input-black" type="text" placeholder="Image URL (Optional)" name="image">
                    </div>
                    <div class="m-1">
                        <label class="mb-1">Name:</label>
                        <input class="form-control e-input-black" type="text" placeholder="Name" name="name">
                    </div>
                    <div class="m-1">
                        <label class="mb-1">Post:</label>
                        <textarea id="post-text"></textarea>
                    </div>
                    <input type="hidden" name="description" id="__e_PostFormDescription">
                    @include('includes.errors')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="__e_PostFormSubmit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
