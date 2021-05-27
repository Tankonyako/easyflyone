<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use Closure;

class AdminChecker
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
        if (!AuthController::isUserLogged() || !AuthController::getCurrentUser()->isAdmin())
            return abort(404);

        return $next($request);
    }
}
