<?php

namespace App\Providers;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultstringLength(191);

        view()->share('captcha', '<div class="g-recaptcha"></div>');
        View::composer('*', function($view){
            View::share('view_name', $view->getName());
        });
    }
}
