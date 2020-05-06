<?php

namespace App\Providers;


use App\Components\BackgroundPicture;
use Illuminate\Support\ServiceProvider;

class ZluServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // регистрируем свой фасад MainHelper
        \App::bind('MainHelper', function(){
            return new \App\Components\MainHelper;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        // передаем рандомный фон во все вьюшки
        \View::share('background', (new BackgroundPicture())->getBg());


    }
}
