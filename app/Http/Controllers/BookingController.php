<?php

namespace App\Http\Controllers;

class BookingController extends Controller
{
    public function startBookingPage($origin, $destination)
    {
        return view('pages.startbooking', [
            'airports' => StaticDataController::getAirports(),
            'origin_iata_code' => $origin,
            'destination_iata_code' => $destination
        ]);
    }
}
