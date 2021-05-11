
<div class="e-tickets e-sh-1 p-2">
    <div class="row">
        <div class="col-md">
            <div class="card e-card-transparent dark text-light mb-0">
                <div class="card-body">
                    <h5 class="card-title e-card-title-adv text-white"><span class="cil-flight-takeoff e-card-title-icon"></span> <span class="e-title">Flight Tickets</span></h5>
                    <p class="card-text">Hey there! Would you like to have pleasant flight for affordable price? We are here for you, choose your origin and destination, take a cup of coffee or tea and enjoy your flight.</p>


                    <p class="mt-1 text-light e-user-agreement">By using our service you agree to our terms and conditions including <a class="e-link" href="{{ route('privacypolicy') }}">privacy policy</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card e-card-transparent dark text-light mb-0">
                <div class="card-body">
                    <h5 class="card-title e-card-title-adv text-white"><span class="cil-barcode e-card-title-icon"></span> <span class="e-title">Scan Ticket</span></h5>

                    <div class="d-flex">
                        <a href="#" class="m-auto" id="__e_ScanQRTicket""><img src="{{ asset('img/qr_code_scan.png') }}" height="100px"></a>
                    </div>
                    <p class="text-light text-center mb-1">or</p>
                    <div class="e-scan-code-form mt-0">
                        <input class="form-control e-ticket-form-control mt-0" placeholder="Ticket Code (EFO-XXX-XXX-XXXXXXXX)" id="__e_TicketUID">
                    </div>

                    <div class="d-flex mt-2">
                        <a href="#" class="m-auto btn btn-ghost-light" id="__e_SearchTicket">Search ticket by Code</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card e-card-transparent dark text-light mb-0">
                <div class="card-body">
                    <h5 class="card-title e-card-title-adv text-white"><span class="cil-compass e-card-title-icon"></span> <span class="e-title">Book a flight</span></h5>
                    <p class="card-text">
                        You need to choose where you want to fly and where, then there will be more settings.
                    </p>
                    <div class="m-0">
                        <p class="m-0 mb-1"><span class="cil-house"></span> Origin: </p>
                        <select class="e-select-advanced e-select form-control" placeholder="Write airport name" name="airport_origin" id="__e_AirportOrigin">
                            @include('includes.airlines', ['default' => 'VNO'])
                        </select>
                        <p class="m-0 mt-2 mb-1"><span class="cil-map"></span> Destination: </p>
                        <select class="e-select-advanced e-select form-control" placeholder="Write airport name" name="airport_destination" id="__e_AirportDestination">
                            @include('includes.airlines', ['default' => 'LAX'])
                        </select>
                        <div class="d-md-flex d-block mt-3">
                            <p class="m-0 mr-auto e-font-2xl"><span class="cil-user-female"></span> Passengers: </p>
                            <nav aria-label="Number of passenger" class="e-select-passenger-home-count ml-auto">
                                <ul class="pagination mb-0">
                                    <li class="page-item"><a data-passengers-count="1" class="page-link __e_ChangePassengersCount active" href="#">1</a></li>
                                    <li class="page-item"><a data-passengers-count="2" class="page-link __e_ChangePassengersCount" href="#">2</a></li>
                                    <li class="page-item"><a data-passengers-count="3" class="page-link __e_ChangePassengersCount" href="#">3</a></li>
                                    <li class="page-item"><a data-passengers-count="4" class="page-link __e_ChangePassengersCount" href="#">4</a></li>
                                    <li class="page-item"><a data-passengers-count="5" class="page-link __e_ChangePassengersCount" href="#">5</a></li>
                                    <li class="page-item"><a data-passengers-count="6" class="page-link __e_ChangePassengersCount" href="#">6</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a class="btn btn-outline-light ml-auto mt-3" id="__e_StartBooking"><span class="cil-airplane-mode"></span> Search booking</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/qr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app/tickets.js') }}"></script>

    <div class="modal fade cd-example-modal-lg qrScanner" tabindex="-1" role="dialog" aria-labelledby="qrScanner" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div style="width: 100%; height: 100%" id="reader"></div>
            </div>
        </div>
    </div>
@endpush
