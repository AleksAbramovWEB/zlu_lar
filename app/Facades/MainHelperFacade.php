<?php


    namespace App\Facades;


    use App\Components\MainHelper;
    use Illuminate\Support\Facades\Facade;

    class MainHelperFacade extends Facade
    {
        protected static function getFacadeAccessor()
        {
            return  'MainHelper';
        }

    }
