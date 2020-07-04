<?php


    namespace App\Components\News\FactoriesNews;


    use App\Models\Connexion\Gifts\GiftsGiven;
    use App\Models\Connexion\News\NewsGiftsGiven;

    class GiftsGivenNews extends NewsAbstract
    {

        protected $nameModel = NewsGiftsGiven::class;
        protected $model = NULL;

        /**
         * @param GiftsGiven $given
         */
        public function addNews($given)
        {
            $whom_user_id = $given->whom_user_id;
            if ($whom_user_id == \Auth::id()) return;

            $this->get_model()::create([
                'user_id' => $whom_user_id,
                'gifts_given_id' => $given->id
            ]);
        }



    }
