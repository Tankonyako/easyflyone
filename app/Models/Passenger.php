<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'photo',
        'passportCountry',
        'passportID',
        'passportExpireDate',
        'seatPosX',
        'seatPosY'
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
        'passportExpireDate' => 'datetime:"d/m/Y"'
    ];

    private static $seat_rows = ['A','B','C',' ','D','E','F',' ','G','H','I',' ','J','K','L',' ','M','N','O',' ','P','Q','R','_','S','T','U',' ','V','W','X',' ','Y','Z'];

    public function getSeatFormatted()
    {
        return ($this->seatPosX+1) . self::$seat_rows[$this->seatPosY + 1];
    }
}
