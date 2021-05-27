<div class="e-navbar e-not-print">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand mr-2" href="/">
                <img src="{{ asset('img/logo.png') }}" height="48px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item e-navbar-title">
                        <p class="e-main-title">{{ config('app.name') }}</p>
                        <p class="e-sub-title">airlines company</p>
                    </li>
                    <li class="nav-item e-navbar-divider"></li>
                    @include('includes.header_button', ['name' => 'Home', 'page' => 'home', 'url' => route('home')])
                    @include('includes.header_button', ['name' => 'News', 'page' => 'news', 'url' => route('news')])
                    <li class="nav-item e-navbar-divider"></li>
                    @include('includes.header_button', ['name' => 'Privacy Policy', 'page' => 'privacypolicy', 'url' => route('privacypolicy')])
                    @include('includes.header_button', ['name' => 'About Us', 'page' => 'about_us', 'url' => route('aboutus')])
                    <li class="nav-item e-navbar-divider"></li>
                    @include('includes.header_button', ['name' => 'Discord', 'page' => 'discord', 'url' => config('app.discord'), 'target' => '_blank'])
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        @if(\App\Http\Controllers\AuthController::isUserLogged())
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="c-avatar-sm rounded-circle mr-2" src="{{ \App\Http\Controllers\AuthController::getCurrentUser()->getAvatar() }}">
                                {{ \App\Http\Controllers\AuthController::getCurrentUser()->getFullName() }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if($user->isAdmin())
                                    <a class="dropdown-item text-danger" href="{{ route('acp') }}">Admin Panel</a>
                                @endif
                                <a class="dropdown-item" href="/my">My Account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout"><span class="cil-account-logout mr-2 font-weight-bolder"></span> Log Out</a>
                            </div>
                        @else
                            <a class="nav-link" href="{{ route('login') }}">My Account</a>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
