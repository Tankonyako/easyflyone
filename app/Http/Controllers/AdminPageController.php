<?php

namespace App\Http\Controllers;

use App\Models\NewFlight;
use App\Models\News;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use Propaganistas\LaravelPhone\PhoneNumber;
use Validator;

class AdminPageController extends Controller
{
    public function indexPage()
    {
        return view('pages.acp', ['page' => 'dashboard']);
    }

    public function usersPage()
    {
        return view('pages.acp_users', ['page' => 'users', 'users' => User::all()]);
    }

    public function newFlightsPage()
    {
        return view('pages.acp_flights', ['page' => 'new_flights', 'newFlights' => NewFlight::all()]);
    }

    public function newsPage()
    {
        return view('pages.acp_news', ['page' => 'new_news', 'newFlights' => NewFlight::all()]);
    }

    public function userInspectPage($id)
    {
        $user = User::where('id', $id)->first();
        if ($user == null)
            return abort(404);

        return view('pages.acp_user', ['page' => 'users', 'foundedUser' => $user]);
    }

    public function removeNews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer'
        ]);

        if ($validator->fails())
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        News::where('id', $request->input('id'))->delete();

        return Redirect::back();
    }

    public function removeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer'
        ]);

        if ($validator->fails())
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        User::where('id', $request->input('id'))->delete();

        return Redirect::route('acp_users');
    }

    public function toggleBlackList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer'
        ]);

        if ($validator->fails())
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        $user = User::where('id', $request->input('id'))->first();
        $user->blocked = !$user->blocked;
        $user->save();

        return Redirect::back();
    }

    public function removeNewFlights(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'integer'
        ]);

        if ($validator->fails())
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        NewFlight::where('id', $request->input('id'))->delete();

        return Redirect::back();
    }

    public function addNewFlights(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:30',
            'description' => 'nullable|min:2|max:235',
            'image' => 'nullable|min:2|max:235',

            'originIata' => 'required|min:2|max:10',
            'destinationIata' => 'required|min:2|max:10',

            'price' => 'required|min:1|max:24',
        ]);

        if ($validator->fails())
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        $newFlight = new NewFlight();
            $newFlight->name = $request->name;
            $newFlight->description = $request->description;
            $newFlight->image = $request->image;

            $newFlight->originIata = $request->originIata;
            $newFlight->destinationIata = $request->destinationIata;

            $newFlight->price = $request->price;
        $newFlight->save();

        return Redirect::back();
    }


    public function addNewPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:300',
            'description' => 'required|min:2',
            'image' => 'required|min:2'
        ]);

        if ($validator->fails())
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();

        $post = new News();
            $post->name = $request->name;
            $post->description = base64_decode($request->description);
            $post->img = $request->image;
            $post->date = time();
        $post->save();

        return Redirect::back();
    }
}
