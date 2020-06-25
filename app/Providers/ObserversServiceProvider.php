<?php

namespace App\Providers;

use App\Models\Admins\Access\Permissions;
use App\Models\Admins\Access\Roles;
use App\Models\Video\CategoriesVideo;
use App\Observers\Admins\Access\PermissionsObserver;
use App\Observers\Admins\Access\RolesObserver;
use App\Observers\Video\CategoriesVideoObserver;
use Illuminate\Support\ServiceProvider;

class ObserversServiceProvider extends ServiceProvider
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
        Roles::observe(RolesObserver::class);
        Permissions::observe(PermissionsObserver::class);
        CategoriesVideo::observe(CategoriesVideoObserver::class);
    }
}
