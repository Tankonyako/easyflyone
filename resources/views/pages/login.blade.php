@extends('layouts.default')
@section('title', 'Log In')
@section('content')
    <style>
        .e-app
        {
            background-image: url(https://wallpaperaccess.com/full/3648768.jpg);
            background-size: cover;
            background-color: #0000007a;
            background-blend-mode: overlay;
        }
    </style>

    <div class="row mt-5 fade-in">
        @if(\App\Http\Controllers\AuthController::isUserLogged())
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 mt-auto mb-auto d-none d-xl-block mh-100">
                        <img src="{{ asset('img/logo.png') }}">
                    </div>

                    <div class="col-lg-6 mt-auto mb-auto">
                        <div class="card e-sh-1">
                            <div class="card-body">
                                @if($logout)
                                    <h5 class="card-title e-card-title-adv"><span class="cil-exit-to-app e-card-title-icon mt-1"></span> <span class="ml-1 e-title">Log Out</span></h5>
                                    <hr>

                                    <div class="m-1">
                                        <p>Do you really want to log out of your account?</p>
                                    </div>

                                    <div class="m-1">
                                        <form id="__e_form_logout" method="POST" action="{{ url('/auth/logout') }}">
                                            @csrf

                                            <button class="btn btn-primary ml-auto mr-2" type="submit">Log Out</button>
                                            <a class="btn btn-secondary ml-auto" href="#" onclick="window.history.go(-1); return false;">Back to website</a>
                                        </form>
                                    </div>
                                @else
                                    <h5 class="card-title e-card-title-adv"><span class="cil-compass e-card-title-icon mt-1"></span> <span class="ml-1 e-title">Redirecting</span></h5>
                                    <hr>

                                    <div class="m-1">
                                        <p>You have successfully logged in, we redirect you to the main page...</p>
                                    </div>

                                    <meta http-equiv="refresh" content="3;url={{ route('home') }}" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg mt-auto mb-auto d-none d-xl-block mh-100">
                        <img src="{{ asset('img/logo.png') }}">
                    </div>

                    <div class="col-lg mt-auto mb-auto">
                        <div class="card e-sh-1">
                            <div class="card-body" id="__e_LoginForm">
                                <form id="__e_form_login" method="POST" action="{{ url('/auth/login') }}">
                                    @csrf
                                    {!! $captcha !!}

                                    <h5 class="card-title e-card-title-adv"><span class="cil-lock-unlocked e-card-title-icon mt-1"></span> <span class="ml-1 e-title">Login</span></h5>
                                    <hr>

                                    <div class="m-1">
                                        <label class="mb-1">Your login:</label>
                                        <input class="form-control e-input-black" type="text" placeholder="EMail or Phone Number" name="login">
                                    </div>

                                    <div class="m-1">
                                        <label class="mb-1">Your password:</label>
                                        <input class="form-control e-input-black" type="password" placeholder="Password" name="login_password">
                                    </div>
                                    <div class="form-check m-1">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
                                        <label class="form-check-label" for="rememberMe">
                                            Remember me?
                                        </label>
                                    </div>
                                    @if(Session::has('errorType') && Session::get('errorType') == 'login')
                                        @include('includes.errors')
                                    @endif
                                    <hr>
                                    <div class="d-flex mt-2">
                                        <p class="mt-1 mb-0">
                                            <a href="#forgotMyPassword" class="e-link-black">I forgot my password</a>
                                            <span class="ml-3">or</span>
                                        </p>
                                        <button class="btn btn-primary ml-auto" id="__e_LoginInAccountLink" type="submit">Log In</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body" id="__e_ForgotPasswordForm" style="display: none">
                                <h5 class="card-title e-card-title-adv"><span class="cil-user-x e-card-title-icon mt-1"></span> <span class="ml-1 e-title">Recover Password</span></h5>
                                <hr>

                                <div class="m-1">
                                    <label class="mb-1">Your login:</label>
                                    <input class="form-control e-input-black" type="text" placeholder="EMail or Phone Number">
                                </div>

                                <hr>
                                <div class="d-flex mt-2">
                                    <p class="mt-1 mb-0">
                                        <a href="#forgotMyPassword" class="e-link-black">Go to login</a>
                                        <span class="ml-3">or</span>
                                    </p>
                                    <a href="#" class="btn btn-primary ml-auto">Recover Password</a>
                                </div>
                            </div>
                        </div>

                        <div class="card e-sh-1">
                            <div class="card-body d-flex mr-0 pr-0">
                                <img src="{{ asset('img/recaptcha.png') }}" class="mr-2" width="48px" height="48px">
                                <div class="mr-0 pr-3 font-xs">
                                    This site is protected by reCAPTCHA and the Google
                                    <a href="https://policies.google.com/privacy">Privacy Policy</a> and
                                    <a href="https://policies.google.com/terms">Terms of Service</a> apply.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg mt-auto mb-auto mb-5">
                <div class="card e-sh-1">
                    <div class="card-body">
                        <form id="__e_form_register" method="POST" action="{{ url('/auth/register') }}">
                            @csrf
                            {!! $captcha !!}

                            <h5 class="card-title e-card-title-adv"><span class="cil-user-female e-card-title-icon mt-1"></span> <span class="ml-1 e-title">Register</span></h5>
                            <hr>
                            <h4>Personal information</h4>

                            <div class="row">
                                <div class="m-1 col-md">
                                    <label class="mb-1">Your first name:</label>
                                    <input class="form-control e-input-black" type="text" placeholder="Ivan" name="firstName" value="{{ old('firstName') }}">
                                </div>
                                <div class="m-1 col-md">
                                    <label class="mb-1">Your last name:</label>
                                    <input class="form-control e-input-black" type="text" placeholder="Ivanov" name="lastName" value="{{ old('lastName') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="m-1 col-md">
                                    <label class="mb-1">Date of birth:</label>
                                    <div class="e-datepicker-container">
                                        <input class="form-control e-input-black e-datepicker" type="text" placeholder="01/01/1980" name="dateOfBirth" value="{{ old('dateOfBirth') }}">
                                        <span class="cil-calendar"></span>
                                    </div>
                                </div>
                                <div class="m-1 col-md">
                                    <label class="mb-1">Gender</label>
                                    <div class="d-flex mt-2">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="radio" name="gender" id="__e_GenderCheckBox_1" value="0" @if(old('gender') == '0') checked @endif>
                                            <label class="form-check-label" for="__e_GenderCheckBox_1">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="__e_GenderCheckBox_2" value="1" @if(old('gender') == '1') checked @endif>
                                            <label class="form-check-label" for="__e_GenderCheckBox_2">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4>Passport information</h4>
                            <div class="row">
                                <div class="m-1 col-md-4 e-select-black">
                                    <label class="mb-1">Passport country:</label>
                                    <select class="e-select-advanced e-select form-control" placeholder="Where passport from" name="passportCountry">
                                        @foreach(\App\Http\Controllers\StaticDataController::getCountries() as $code => $name)
                                            <option value="{{ $name }}" {{ ($name == old('passportCountry', "Lithuania"))?'selected':'' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="m-1 col-md">
                                    <label class="mb-1">Passport ID:</label>
                                    <input class="form-control e-input-black" type="text" placeholder="00000000000" name="passportId" value="{{ old('passportId') }}">
                                </div>
                                <div class="m-1 col-md">
                                    <label class="mb-1">Passport expire date:</label>
                                    <div class="e-datepicker-container">
                                        <input class="form-control e-input-black e-datepicker" type="text" placeholder="01/01/1980" name="passportPeriod" value="{{ old('passportPeriod') }}">
                                        <span class="cil-calendar"></span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4>Address information</h4>
                            <div class="row">
                                <div class="m-1 col-md-4 e-select-black">
                                    <label class="mb-1">Address country:</label>
                                    <select class="e-select-advanced e-select form-control" placeholder="Where your address" name="addressCountry">
                                        @foreach(\App\Http\Controllers\StaticDataController::getCountries() as $code => $name)
                                            <option value="{{ $name }}" {{ ($name == old('addressCountry', "Lithuania"))?'selected':'' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="m-1 col-md">
                                    <label class="mb-1">Address Post Code:</label>
                                    <input class="form-control e-input-black" type="text" placeholder="XX-00000" name="addressPostCode" value="{{ old('addressPostCode') }}">
                                </div>
                                <div class="m-1 col-md"></div>
                            </div>
                            <div class="row">
                                <div class="m-1 col-md-4">
                                    <label class="mb-1">Address city:</label>
                                    <input class="form-control e-input-black" type="text" placeholder="Vilnus" name="addressCity" value="{{ old('addressCity') }}">
                                </div>
                                <div class="m-1 col-md">
                                    <label class="mb-1">City, Street and number:</label>
                                    <input class="form-control e-input-black" type="text" placeholder="City, Street 13" name="addressDetail" value="{{ old('addressDetail') }}">
                                </div>
                            </div>
                            <hr>
                            <h4>Contact information</h4>
                            <div class="row">
                                <div class="m-1 col-md-6">
                                    <label class="mb-1">Your phone number (International):</label>
                                    <input class="form-control e-input-black" type="text" placeholder="+X XXX XXX XXXX" name="contactPhoneNumber" value="{{ old('contactPhoneNumber') }}">
                                </div>
                                <div class="m-1 col-md-4 e-select-black">
                                    <label class="mb-1">Primary Language:</label>
                                    <select class="e-select-advanced e-select form-control" placeholder="Your primary language" name="contactLanguage">
                                        @foreach(\App\Http\Controllers\StaticDataController::getLanguages() as $code => $name)
                                            <option value="{{ $name }}" {{ ($name == old('contactLanguage', "Lithuanian"))?'selected':'' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="m-1 col-md-4">
                                    <label class="mb-1">Your EMail:</label>
                                    <input class="form-control e-input-black" type="text" placeholder="tesad@dsadsa.dsadsa" name="contactEmail" value="{{ old('contactEmail') }}">
                                </div>
                            </div>
                            <hr>
                            <h4>Security</h4>
                            <div class="row">
                                <div class="m-1 col-md-4">
                                    <label class="mb-1">Your password:</label>
                                    <input class="form-control e-input-black" type="password" placeholder="qwerty" name="password">
                                </div>
                                <div class="m-1 col-md-4">
                                    <label class="mb-1">Confirm password:</label>
                                    <input class="form-control e-input-black" type="password" placeholder="qwerty" name="password_confirmation">
                                </div>
                                <div class="m-1 col-md-12">
                                    @if(Session::has('errorType') && Session::get('errorType') == 'register')
                                        @include('includes.errors')
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="form-check m-1">
                                <input class="form-check-input" type="checkbox" value="" id="__e_AcceptPolicy">
                                <label class="form-check-label" for="__e_AcceptPolicy">
                                    I consent to the <a href="{{ route('privacypolicy') }}" class="e-link-black" target="_blank">Privacy Policy</a> and agree to the processing of my personal data.
                                </label>
                            </div>
                            <hr>
                            <div class="d-flex mt-2">
                                <button class="btn btn-primary ml-auto disabled" id="__e_CreateAccountLink" type="submit">Create account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop

@push('meta')
    <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/app/login.js') }}"></script>
    @include('includes.captcha-script')
@endpush
