<?php

namespace App\Http\Controllers;

use App\Models\NewFlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ProfileController extends Controller
{
    public function myProfile($type = "my")
    {
        if (!AuthController::isUserLogged())
            return redirect()->route('login');

        return view('pages.my', ['type' => $type]);
    }

    public function changePassword(Request $request)
    {
        if (!AuthController::isUserLogged())
            return redirect()->route('login');

        $validator = Validator::make($request->all(), [
            'password_old' => 'required|min:5|max:24',
            'password' => 'required|min:5|max:24|confirmed'
        ]);

        if ($validator->fails())
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        if (sha1($request->input('password_old')) != AuthController::getCurrentUser()->password)
            return Redirect::back()
                ->withErrors(['Your password does not match the current one.'])
                ->withInput();

        $user = AuthController::getCurrentUser();
        $user->password = sha1($request->input('password'));
        $user->save();

        AuthController::logoutUser();

        return Redirect::back();
    }
}
