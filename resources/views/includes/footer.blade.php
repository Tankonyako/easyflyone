<div class="e-footer e-sh-1 e-not-print">
    <div class="container">
        <div class="row pt-3 pb-3 text-light">
            <div class="col-md d-flex">
                <img src="{{ asset('img/logo.png') }}" class="my-auto ml-auto" height="128px">
            </div>
            <div class="col-md">
                <h3 class="font-weight-lighter mt-4">EasyFly.One</h3>
                <hr class="dropdown-divider">
                <p class="mb-1">Copyright {{ date('Y') }} EasyFly.One, Inc.</p>
                <p class="text-muted">All rights reserved. Copyright is owned by EasyFly.One, Inc.</p>

                <div class="d-flex flex-wrap">
                    <span class="mr-1 pw pw-visa font-4xl text-light"></span>
                    <span class="mr-1 pw pw-visa-electron font-4xl text-light"></span>
                    <span class="mr-1 pw pw-mastercard font-4xl text-light"></span>
                    <span class="mr-1 pw pw-maestro font-4xl text-light"></span>
                    <span class="mr-1 pw pw-skrill font-4xl text-light"></span>
                    <span class="mr-1 pw pw-westernunion font-4xl text-light"></span>
                    <span class="mr-1 pw pw-ripple font-4xl text-light"></span>
                    <span class="mr-1 pw pw-paypal font-4xl text-light"></span>
                    <span class="mr-1 pw pw-bitcoin-sign font-4xl text-light"></span>
                </div>
            </div>
            <div class="col-md">
                <h4 class="mb-2 ml-3 mt-4">Useful links: </h4>
                <ul class="list-group m-0 p-0 ml-3">
                    <li class="list-group-item pl-0 text-light pt-0 pb-1"><a class="e-link" href="{{ route('privacypolicy') }}">Privacy Policy</a></li>
                    <li class="list-group-item pl-0 text-light pt-0 pb-1"><a class="e-link" href="{{ route('aboutus') }}">About Us</a></li>
                    <li class="list-group-item pl-0 text-light pt-0 pb-1"><a class="e-link" href="{{ config('app.discord') }}">Our Discord</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
