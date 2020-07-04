<?php


    namespace App\Facades;


    use App\Components\MainHelper;
    use Illuminate\Support\Facades\Facade;

    class NewsFacade extends Facade
    {
        protected static function getFacadeAccessor()
        {
            return  'News';
        }

    }
