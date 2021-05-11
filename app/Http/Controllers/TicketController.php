<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class TicketController extends Controller
{
    public static function getRandomID()
    {
        $r1 = "00" . strtoupper(Str::random(1));
        $r2 = strtoupper(Str::random(3));
        $r3 = '0' . strtoupper(Str::random(6)) . '0';
        return "EFO-$r1-$r2-$r3";
    }
}
