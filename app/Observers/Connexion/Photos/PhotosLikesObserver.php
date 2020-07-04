<?php

namespace App\Observers\Connexion\Photos;

use App\Models\Connexion\Photos\PhotosLikes;

class PhotosLikesObserver
{
    /**
     * Handle the photos likes "created" event.
     *
     * @param  \App\Models\Connexion\Photos\PhotosLikes  $photosLikes
     * @return void
     */
    public function created(PhotosLikes $photosLikes)
    {
        \News::addNews('likes_photo', $photosLikes);
    }

    /**
     * Handle the photos likes "updated" event.
     *
     * @param  \App\Models\Connexion\Photos\PhotosLikes  $photosLikes
     * @return void
     */
    public function updated(PhotosLikes $photosLikes)
    {
        //
    }

    /**
     * Handle the photos likes "deleted" event.
     *
     * @param  \App\Models\Connexion\Photos\PhotosLikes  $photosLikes
     * @return void
     */
    public function deleted(PhotosLikes $photosLikes)
    {
        //
    }

    /**
     * Handle the photos likes "restored" event.
     *
     * @param  \App\Models\Connexion\Photos\PhotosLikes  $photosLikes
     * @return void
     */
    public function restored(PhotosLikes $photosLikes)
    {
        //
    }

    /**
     * Handle the photos likes "force deleted" event.
     *
     * @param  \App\Models\Connexion\Photos\PhotosLikes  $photosLikes
     * @return void
     */
    public function forceDeleted(PhotosLikes $photosLikes)
    {
        //
    }
}
