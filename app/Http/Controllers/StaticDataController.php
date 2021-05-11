<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class StaticDataController extends BaseController
{
    //TODO: CACHE
    public static function getCountries()
    {
        return json_decode(file_get_contents(public_path('data/countries.json')));
    }

    public static function getLanguages()
    {
        return json_decode(file_get_contents(public_path('data/languages.json')));
    }

    public static function getAirports()
    {
        return json_decode(file_get_contents(public_path('data/airports.json')));
    }

    public static function getAirportByIata($iata)
    {
        $airports = self::getAirports();

        foreach ($airports as $airport)
        {
            if ($airport->iata_code == $iata)
            {
                return $airport;
                break;
            }
        }
        return $airports[0];
    }

    public static function getDistanceBetween(
        $lat1, $lon1, $lat2, $lon2, $unit = 'K')
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}
