<?php

use App\Http\Controllers\AdminPageController;
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

Route::get('/blocked', [AuthPageController::class, 'blockedPage'])->name('blocked');

Route::get('/my', [\App\Http\Controllers\ProfileController::class, 'myProfile'])->name("my");
Route::get('/my/{type}', [\App\Http\Controllers\ProfileController::class, 'myProfile']);

Route::get('/news', [NewsController::class, 'newsPage'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'newsSpecifyPage']);

Route::any('/tickets/add', [\App\Http\Controllers\TicketPageController::class, 'addTicket'])->name('ticketsAdd');
Route::get('/ticket/{id}', [\App\Http\Controllers\TicketPageController::class, 'viewTicket'])->name('viewTicket');

Route::get('/startbook/{origin}/{destination}', [BookingController::class, 'startBookingPage']);

Route::get('/acp/dashboard', [AdminPageController::class, 'indexPage'])->middleware('admin.checker')->name('acp');
Route::get('/acp/users', [AdminPageController::class, 'usersPage'])->middleware('admin.checker')->name('acp_users');
Route::get('/acp/new_flights', [AdminPageController::class, 'newFlightsPage'])->middleware('admin.checker')->name('new_flights');
Route::get('/acp/new_news', [AdminPageController::class, 'newsPage'])->middleware('admin.checker')->name('new_news');
Route::post('/acp/add/new_flights', [AdminPageController::class, 'addNewFlights'])->middleware('admin.checker');
Route::post('/acp/add/post', [AdminPageController::class, 'addNewPost'])->middleware('admin.checker');
Route::post('/acp/remove/new_flights', [AdminPageController::class, 'removeNewFlights'])->middleware('admin.checker');
Route::post('/acp/remove/news', [AdminPageController::class, 'removeNews'])->middleware('admin.checker');
Route::post('/acp/remove/user', [AdminPageController::class, 'removeUser'])->middleware('admin.checker');
Route::post('/acp/toggleblacklist/user', [AdminPageController::class, 'toggleBlackList'])->middleware('admin.checker');
Route::get('/acp/user/{id}', [AdminPageController::class, 'userInspectPage'])->middleware('admin.checker')->name('acp_user');

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


