<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function myProfile($type = "my")
    {
        if (!AuthController::isUserLogged())
            return redirect()->route('login');

        return view('pages.my', ['type' => $type]);
    }
}
