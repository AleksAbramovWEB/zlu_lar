<?php

namespace App\Observers\Connexion\Photos;

use App\Models\Connexion\Photos\PhotosComment;

class PhotosCommentObserver
{
    /**
     * Handle the photos comment "created" event.
     *
     * @param  \App\Models\Connexion\Photos\PhotosComment  $photosComment
     * @return void
     */
    public function created(PhotosComment $photosComment)
    {
        \News::addNews('comment_photo', $photosComment);
    }

    /**
     * Handle the photos comment "updated" event.
     *
     * @param  \App\Models\Connexion\Photos\PhotosComment  $photosComment
     * @return void
     */
    public function updated(PhotosComment $photosComment)
    {
        //
    }

    /**
     * Handle the photos comment "deleted" event.
     *
     * @param  \App\Models\Connexion\Photos\PhotosComment  $photosComment
     * @return void
     */
    public function deleted(PhotosComment $photosComment)
    {
        //
    }

    /**
     * Handle the photos comment "restored" event.
     *
     * @param  \App\Models\Connexion\Photos\PhotosComment  $photosComment
     * @return void
     */
    public function restored(PhotosComment $photosComment)
    {
        //
    }

    /**
     * Handle the photos comment "force deleted" event.
     *
     * @param  \App\Models\Connexion\Photos\PhotosComment  $photosComment
     * @return void
     */
    public function forceDeleted(PhotosComment $photosComment)
    {
        //
    }
}
