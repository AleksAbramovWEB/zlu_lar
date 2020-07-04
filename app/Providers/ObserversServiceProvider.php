<?php

namespace App\Providers;

use App\Models\Admins\Access\Permissions;
use App\Models\Admins\Access\Roles;
use App\Models\Connexion\Gifts\GiftsGiven;
use App\Models\Connexion\Photos\PhotosComment;
use App\Models\Connexion\Photos\PhotosLikes;
use App\Models\Video\CategoriesVideo;
use App\Observers\Admins\Access\PermissionsObserver;
use App\Observers\Admins\Access\RolesObserver;
use App\Observers\Connexion\Gifts\GiftsGivenObserver;
use App\Observers\Connexion\Photos\PhotosCommentObserver;
use App\Observers\Connexion\Photos\PhotosLikesObserver;
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
        PhotosLikes::observe(PhotosLikesObserver::class);
        PhotosComment::observe(PhotosCommentObserver::class);
        GiftsGiven::observe(GiftsGivenObserver::class);
    }
}
