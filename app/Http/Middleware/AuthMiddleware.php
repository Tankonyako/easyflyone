<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        view()->share('user', AuthController::getCurrentUser()); // Check if we logged for first time.

        if (AuthController::isUserLogged() && Route::getCurrentRoute()->uri != 'blocked')
            if (AuthController::getCurrentUser()->blocked)
                return redirect()->route('blocked');

        return $next($request);
    }
}
