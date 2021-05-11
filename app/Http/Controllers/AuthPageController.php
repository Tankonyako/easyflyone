<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use Propaganistas\LaravelPhone\PhoneNumber;
use Validator;

class AuthPageController extends Controller
{
    public function indexPage()
    {
        return view('pages.login', ['logout' => false]);
    }

    public function logoutPage()
    {
        return view('pages.login', ['logout' => true]);
    }

    public function logout(Request $request)
    {
        if (AuthController::isUserLogged())
            AuthController::logoutUser();

        return \redirect(route('login'))
            ->with(['toast' => [['type' => 'info', 'message' => 'You was log out!']]]);;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => config('app.debug') ? 'nullable' : 'recaptcha',

            'login' => 'required|min:2|max:30',

            'login_password' => 'required|min:5|max:24',
        ]);

        session()->flash('errorType', 'login');

        if ($validator->fails())
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        $user = AuthController::getUserByPhoneOrEmailAndPassword($request->input("login"), $request->input("login_password"));

        if (is_null($user))
            return Redirect::back()
                ->withErrors(['Your email, phone or password is invalid.'])
                ->withInput();

        AuthController::loginUserById($user->id, $request->has('rememberMe'));

        return \redirect(route('login'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => config('app.debug') ? 'nullable' : 'recaptcha',

            'firstName' => 'required|min:2|max:20',
            'lastName' => 'required|min:2|max:20',
            'dateOfBirth' => 'required|min:3|max:15|date_format:"d/m/Y"',

            'gender' => 'required|boolean',

            'passportCountry' => 'required|min:2|max:30',
            'passportId' => 'required|min:2|max:13',
            'passportPeriod' => 'required|min:3|max:15|date_format:"d/m/Y"',

            'addressCountry' => 'required|min:2|max:30',
            'addressCity' => 'required|min:2|max:25',
            'addressPostCode' => 'required|min:2|max:25',
            'addressDetail' => 'required|min:2|max:80',

            'contactPhoneNumber' => 'required|phone:AUTO',
            'contactEmail' => 'required|min:2|max:30|email',
            'contactLanguage' => 'required|min:2|max:30',

            'password' => 'required|min:5|max:24|confirmed'
        ]);

        session()->flash('errorType', 'register');

        if ($validator->fails())
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        $userRecord = AuthController::getUserByPhoneOrWithEmail($request->input("contactEmail"), PhoneNumber::make($request->input("contactPhoneNumber")));

        if (!is_null($userRecord))
            return Redirect::back()
                ->withErrors(['User already created by this Email or Phone number.'])
                ->withInput();

        $user = new User();
            $user->firstName = $request->input("firstName");
            $user->lastName = $request->input("lastName");
            $user->dateOfBirth = Carbon::createFromFormat("d/m/Y", $request->input("dateOfBirth"));

            $user->gender = $request->input("gender");

            $user->passportCountry = $request->input("passportCountry");
            $user->passportId = $request->input("passportId");
            $user->passportPeriod = Carbon::createFromFormat("d/m/Y", $request->input("passportPeriod"));

            $user->addressCountry = $request->input("addressCountry");
            $user->addressCity = $request->input("addressCity");
            $user->addressPostCode = $request->input("addressPostCode");
            $user->addressDetail = $request->input("addressDetail");

            $user->contactPhoneNumber = PhoneNumber::make($request->input("contactPhoneNumber"));
            $user->contactEmail = $request->input("contactEmail");
            $user->contactLanguage = $request->input("contactLanguage");

            $user->password = sha1($request->input("password"));
        $user->save();

        AuthController::loginUserById($user->id, true);

        return \redirect(route('login'));
    }
}
