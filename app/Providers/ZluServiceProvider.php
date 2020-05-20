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
        // регистрируем свой фасад MainHelper Declination
        \App::bind('MainHelper', function(){
            return new \App\Components\MainHelper;
        });
        \App::bind('Declination', function(){
            return new \App\Components\Declination;
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
