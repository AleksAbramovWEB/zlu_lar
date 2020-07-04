<?php

namespace App\Observers\Connexion\Gifts;

use App\Models\Connexion\Gifts\GiftsGiven;

class GiftsGivenObserver
{
    /**
     * Handle the gifts given "created" event.
     *
     * @param  \App\Models\Connexion\Gifts\GiftsGiven  $giftsGiven
     * @return void
     */
    public function created(GiftsGiven $giftsGiven)
    {
        \News::addNews('gifts_given', $giftsGiven);
    }

    /**
     * Handle the gifts given "updated" event.
     *
     * @param  \App\Models\Connexion\Gifts\GiftsGiven  $giftsGiven
     * @return void
     */
    public function updated(GiftsGiven $giftsGiven)
    {
        //
    }

    /**
     * Handle the gifts given "deleted" event.
     *
     * @param  \App\Models\Connexion\Gifts\GiftsGiven  $giftsGiven
     * @return void
     */
    public function deleted(GiftsGiven $giftsGiven)
    {
        //
    }

    /**
     * Handle the gifts given "restored" event.
     *
     * @param  \App\Models\Connexion\Gifts\GiftsGiven  $giftsGiven
     * @return void
     */
    public function restored(GiftsGiven $giftsGiven)
    {
        //
    }

    /**
     * Handle the gifts given "force deleted" event.
     *
     * @param  \App\Models\Connexion\Gifts\GiftsGiven  $giftsGiven
     * @return void
     */
    public function forceDeleted(GiftsGiven $giftsGiven)
    {
        //
    }
}
