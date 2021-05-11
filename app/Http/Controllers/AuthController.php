<?php

namespace App\Http\Controllers;

use App\Models\User;
use Propaganistas\LaravelPhone\PhoneNumber;

class AuthController extends Controller
{
    public static $SESSION_USER_ID_KEY = '_e_u_id';
    public static $SESSION_USER_ID_LIVE = '_e_u_live';

    private static $userLoaded = false;
    private static $user = null;

    /**
     * @return User
     */
    public static function getCurrentUser()
    {
        if (session()->has(self::$SESSION_USER_ID_LIVE))
        {
            if (time() >= session()->get(self::$SESSION_USER_ID_LIVE))
            {
                self::logoutUser();
                return null;
            }
            else
            {
                session()->put(self::$SESSION_USER_ID_LIVE, time() + (60 * 60 * 1));
            }
        }
        return session()->has(self::$SESSION_USER_ID_KEY) ?
            (self::$userLoaded ? self::$user : (self::retryUserForFirstTime()))
            : null;
    }

    public static function isUserLogged()
    {
        return self::$userLoaded && self::$user != null;
    }

    public static function getUserByPhoneOrEmailAndPassword($mailorphone, $password)
    {
        $user = User::where('contactEmail', $mailorphone)
            ->orWhere('contactPhoneNumber', PhoneNumber::make($mailorphone))
            ->first();

        if ($user != null && $user->password == sha1($password))
            return $user;

        return null;
    }

    public static function getUserByPhoneOrWithEmail($mail, $phone)
    {
        return User::where('contactEmail', $mail)
            ->orWhere('contactPhoneNumber', PhoneNumber::make($phone))
            ->first();
    }

    public static function getUserById($id)
    {
        return User::where('id', $id)->first();
    }

    public static function loginUserById($id, $remember = false)
    {
        session()->put(self::$SESSION_USER_ID_KEY, $id);
        session()->put(self::$SESSION_USER_ID_LIVE, time() + ($remember ? 60 * 60 * 24 * 25 : 60 * 60 * 1 )); // In seconds
    }

    private static function retryUserForFirstTime()
    {
        self::$user = self::getUserById(session()->get(self::$SESSION_USER_ID_KEY));
        self::$userLoaded = true;

        return self::$user;
    }

    public static function logoutUser()
    {
        session()->remove(self::$SESSION_USER_ID_KEY);
        session()->remove(self::$SESSION_USER_ID_LIVE);
    }
}
