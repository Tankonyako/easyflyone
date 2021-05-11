<?php

namespace App\Models;

use App\Http\Controllers\StaticDataController;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'createdbyid',
        'generatedDate',
        'passengers',
        'passengersLimit',
        'departureDate',
        'returnDate',
        'willReturn',
        'originIataCode',
        'destinationIataCode',
        'airwayid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'generatedDate' => 'datetime:"d/m/Y"',
        'departureDate' => 'datetime:"d/m/Y"',
        'returnDate' => 'datetime:"d/m/Y"',

        'passengers' => 'array',

        'willReturn' => 'boolean',
        'createdbyid' => 'integer',
    ];

    public function getOrigin()
    {
        return StaticDataController::getAirportByIata($this->originIataCode);
    }

    public function getDestination()
    {
        return StaticDataController::getAirportByIata($this->destinationIataCode);
    }

    public function getPassengers()
    {
        $passengers = [];
        foreach ($this->passengers as $passengerId)
        {
            $passengers[] = Passenger::where('id', $passengerId)->first();
        }
        return $passengers;
    }
}
