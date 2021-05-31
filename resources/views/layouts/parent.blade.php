<html lang="en">
<head>
    <title>{{ config('app.name') }} - @yield('title')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/coreui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/coreui_icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datapicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/payment-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

    @stack('styles')
    @stack('meta')
</head>
<body class="e-app e-default-app">

    @if(config('app.debug'))
        <script>window.debug = true;</script>
    @endif

    <script>
        window.currentUser = {};
        @if(!\App\Http\Controllers\AuthController::isUserLogged())
            currentUser.isLogged = false;
        @else
            currentUser = JSON.parse(`{!! \App\Http\Controllers\AuthController::getCurrentUser()->serialize() !!}`.replaceAll('\"\"', '\"'));
            currentUser.isLogged = true;
        @endif
        window.newFlights = [];
        @foreach(\App\Models\NewFlight::all() as $newFlight)
            window.newFlights.push({
                @if($newFlight->name)
                    name: `{{ $newFlight->name }}`,
                @endif
                    @if($newFlight->image)
                    image: `{{ $newFlight->image }}`,
                @endif
                    @if($newFlight->description)
                    description: `{{ $newFlight->description }}`,
                @endif
                @if($newFlight->price)
                    price: `{{ $newFlight->price }}`,
                @endif
                @if($newFlight->originIata)
                    originIata: `{{ $newFlight->originIata }}`,
                @endif
                @if($newFlight->destinationIata)
                    destinationIata: `{{ $newFlight->destinationIata }}`,
                @endif
            });
        @endforeach
    </script>

    @yield('beforeParent')
        @yield('parent')
    @yield('afterParent')

    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popperjs.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datapicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/moment.duration.addon.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/wow.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app/utils.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>

    @if (Session::has('toast'))
        <script>
            $(document).ready(function() {
                @foreach(Session::get('toast') as $toast)
                    toastr[`{{ $toast['type'] }}`](`{{ $toast['message'] }}`);
                @endforeach
            });
        </script>
     @endif

    @stack('scripts')
</body>
</html>
