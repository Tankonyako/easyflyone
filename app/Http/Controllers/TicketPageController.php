<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Ticket;
use ArrayObject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class TicketPageController extends Controller
{
    public function viewTicket($id)
    {
        $ticket = Ticket::where('uid', $id)->first();
        $ticketFounded = $ticket != null;

        return view('pages.view_ticket', ['ticket' => $ticket, 'foundTicket' => $ticketFounded]);
    }

    public function addTicket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payload' => 'required|min:30|max:99999999',

            'email' => 'required|min:5|max:24|email',
        ]);

        if ($validator->fails())
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        $payload = json_decode($request->payload, true);
//        $validatorTicket = Validator::make($payload, [
//            'login' => 'required|min:2|max:30',
//
//            'login_password' => 'required|min:5|max:24',
//        ]);
//
//        if ($validatorTicket->fails())
//            return Redirect::back()
//                ->withErrors($validatorTicket)
//                ->withInput();

        $passengersJson = $payload['passengers'];

        $passengers = [];
        foreach ($passengersJson as $passengerJson)
        {
            $seatPosJson = $passengerJson['seatPos'];
            unset($passengerJson['seatPos']);

            $passengerJson['seatPosX'] = $seatPosJson['x'];
            $passengerJson['seatPosY'] = $seatPosJson['y'];

            $passenger = new Passenger();
            $passenger->forceFill($passengerJson);
            $passenger->save();

            $passengers[] = $passenger->id;
        }

        unset($payload['id']);

        $payload['passengers'] = $passengers;

        $ticket = new Ticket();
        $ticket->forceFill($payload);
        $ticket->uid = \App\Http\Controllers\TicketController::getRandomID();
        $ticket->createdbyid = -1;
        if (AuthController::isUserLogged())
            $ticket->createdbyid = AuthController::getCurrentUser()->id;
        $ticket->generatedDate = Carbon::createFromFormat("d/m/Y", $payload['generatedDate']);
        $ticket->departureDate = Carbon::createFromFormat("d/m/Y", $payload['departureDate']);
        $ticket->returnDate = Carbon::createFromFormat("d/m/Y", $payload['returnDate']);
        $ticket->save();

        return redirect()->route('viewTicket', $ticket->uid)->with('new', true);
    }
}
