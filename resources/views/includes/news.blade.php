@php($ad = false)

@if(isset($newsid))
    @php($posts = \App\Models\News::where('id', $newsid)->take(1)->get())
    @php($limit = 1)

    @push('scripts')
        <script type="text/javascript" src="{{ asset('js/sharerbox.js') }}"></script>
    @endpush
@else
    @php($posts = \App\Models\News::take($limit)->get())
@endif

<div class="@if(!$min) e-news @endif p-2">
    <h1 class="font-weight-light text-center mt-2">@if(isset($newsid)) {{ $posts[0]->name }} @else EasyFly Journal News @endif</h1>
    <div class="row">
        @foreach($posts as $post)
            <div class="@if($horizontal) col-md-10 @else col-md-4 @endif h-100 pb-0">
                <div class="e-post mb-0 pt-3 pr-3 pl-3 pb-0">
                    @if($horizontal) <div class="row"> @endif
                        @if($horizontal) <div class="col-md-4"> @endif
                            <img class="card-img-top e-round e-sh-1 mb-2" src="{{ $post->img }}">
                            @if($limit == 1)
                                <p class="text-center text-secondary mt-1 mb-0 e-post-date">Date of post {{ $post->date }}</p>
                            @endif
                        @if($horizontal) </div> @endif
                        @if($horizontal) <div class="col-md-8"> @endif
                            @if($limit == 1)
                                <script>
                                    window.onload = function()
                                    {
                                        sharerboxIcons('facebook, twitter, reddit, telegram');

                                        // Setup arguments: Behavior, Position, Color, Visibility, Description
                                        sharerSetup('pop-up', 'left', 'black', true,
                                            '{{ $post->name }},\r\n' +
                                            (`{{ implode(' ', array_slice(explode(' ', strip_tags($post->description)), 0, 15)) }}...`.replaceAll('\n', '').replaceAll('\t', '')) +
                                            '\r\n\r\n'
                                        );
                                    };
                                </script>
                                @push('meta')
                                    <meta property="og:title" content="{{ $post->name }}">
                                    <meta property="og:description" content="{{ implode(' ', array_slice(explode(' ', strip_tags($post->description)), 0, 15)) }}...">
                                    <meta property="og:image" content="{{ $post->img }}">
                                    <meta property="og:url" content="{{ url()->current() }}">
                                @endpush
                                {!! $post->description !!}
                            @else
                                <a class="font-weight-normal mt-2 e-post-title e-link" href="/news/{{ $post->id }}">{{ $post->name }}</a>
                                <hr class="dropdown-divider">
                                <p class="font-weight-lighter mt-2 mb-0">{!! implode(' ', array_slice(explode(' ', strip_tags($post->description)), 0, $limit > 8 ? 70 : 15)) !!}...</p>
                            @endif
                            <p class="text-right e-news-date mt-1 mb-0">{{ $post->date }}</p>
                        @if($horizontal) </div> @endif
                    @if($horizontal) </div> @endif

                    @if($user && $user->isAdmin())
                        <form method="POST" action="/acp/remove/news">
                            @csrf
                            <input type="hidden" name="id" value="{{ $post->id }}">
                            <button type="submit" class="btn btn-danger btn-sm mt-1 mx-auto">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
            @if(!$ad && $limit != 3 && !$min)
                <div class="col-md-2">
                    <img src="https://trainify.in/wp-content/uploads/2019/05/Ad_could_be_here.png" width="100%">
                </div>
                @php($ad = true)
            @endif
        @endforeach
    </div>
    @if($showmore)
        <div class="d-flex">
            <a class="btn btn-outline-light mx-auto w-25 mb-3 mt-3" href="{{ route('news') }}"><span class="cil-inbox mr-1"></span>Show more</a>
        </div>
    @else
        <p class="text-center text-muted">Loaded {{ count($posts) }} posts.</p>
    @endif
</div>
