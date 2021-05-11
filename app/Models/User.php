<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'firstName',
        'lastName',
        'dateOfBirth',

        'gender',

        'passportCountry',
        'passportId',
        'passportPeriod',

        'addressCountry',
        'addressCity',
        'addressPostCode',
        'addressDetail',

        'contactPhoneNumber',
        'contactEmail',
        'contactEmailVerifiedAt',
        'contactLanguage',

        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dateOfBirth' => 'datetime:"d/m/Y"',

        'gender' => 'boolean',

        'passportId' => 'integer',
        'passportPeriod' => 'datetime:"d/m/Y"',

        'contactEmailVerifiedAt' => 'datetime:"d/m/Y"',
    ];

    public function getAvatar()
    {
        //TODO: User Photo
        return 'https://i.imgur.com/kL4xVxs.png';
    }

    public function getFullName()
    {
        return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName);
    }

    public function serialize()
    {
        $copied = unserialize(serialize($this));

        return $copied->toJson(JSON_PRETTY_PRINT);
    }

    public function getTickets()
    {
        return Ticket::where('createdbyid', $this->id)->get();
    }

    public function getSecuredEmail()
    {
        $v = explode('@', $this->contactEmail);
        return count($v) > 1 ? substr($v[0], 0, strlen($v[0]) / 2) . substr('***********************************************', 0, strlen($v[0]) / 2) . '@' . $v[1] : $this->contactEmail;
    }
}
