<?php

use App\Http\Controllers\AuthPageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name("home");

Route::get('/login', [AuthPageController::class, 'indexPage'])->name("login");
Route::get('/logout', [AuthPageController::class, 'logoutPage'])->name("logout");
Route::post('/auth/register', [AuthPageController::class, 'register']);
Route::post('/auth/login', [AuthPageController::class, 'login']);
Route::post('/auth/logout', [AuthPageController::class, 'logout']);

Route::get('/my', [\App\Http\Controllers\ProfileController::class, 'myProfile'])->name("my");
Route::get('/my/{type}', [\App\Http\Controllers\ProfileController::class, 'myProfile']);

Route::get('/news', [NewsController::class, 'newsPage'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'newsSpecifyPage']);

Route::any('/tickets/add', [\App\Http\Controllers\TicketPageController::class, 'addTicket'])->name('ticketsAdd');
Route::get('/ticket/{id}', [\App\Http\Controllers\TicketPageController::class, 'viewTicket'])->name('viewTicket');

Route::get('/startbook/{origin}/{destination}', [BookingController::class, 'startBookingPage']);

Route::get('/privacypolicy', function () {
    return view('pages.privacypolicy');
})->name("privacypolicy");
Route::get('/aboutus', function () {
    return view('pages.about_us');
})->name("aboutus");
Route::get('/r', function () {
    return \App\Http\Controllers\TicketController::getRandomID();
});





Route::get('/test', function () {
    $user = \App\Http\Controllers\AuthController::getCurrentUser();
    Mail::send('emails.test', ['user' => $user], function ($m) use ($user) {
        $m->to('kirill@7b.by', 'kiryl')->subject('Your Reminder!');
    });
});


