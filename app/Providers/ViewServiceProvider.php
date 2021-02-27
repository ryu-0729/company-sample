<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            //ログインしていた場合にログインユーザーのデータをviewに渡す
            if (auth()->check()) {
                $login_user = Auth::user();
                $view->with('login_user', $login_user);
            }
        });
    }
}
