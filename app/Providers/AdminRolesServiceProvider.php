<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminRolesServiceProvider extends ServiceProvider
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

        \Blade::directive('admin', function (){
            return "<?php if( \Auth::user()->can('admins') ): ?>";
        });

        \Blade::directive('endadmin', function (){
            return "<?php endif; ?>";
        });


        \Blade::directive('role', function ($role){
            return "<?php if(\Auth::check() AND \Auth::user()->hasRole({$role}) ): ?>";
        });

        \Blade::directive('endrole', function (){
            return "<?php endif; ?>";
        });
    }
}
