<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        /* \DB::listen(function($q){

            // SQL文
            dump($q->sql);

            // パラメータ
            dump($q->bindings);

            // 実行にかかった時間
            dump($q->time);

        }); */
    }
}
