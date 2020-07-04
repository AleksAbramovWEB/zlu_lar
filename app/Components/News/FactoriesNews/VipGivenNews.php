<?php


    namespace App\Components\News\FactoriesNews;


    use App\Models\Connexion\News\NewsVipGiven;

    class VipGivenNews extends NewsAbstract
    {

        protected $nameModel = NewsVipGiven::class;
        protected $model = NULL;

        /**
         * @param array $vip
         */
        public function addNews($vip)
        {
            if ($vip['user_id'] == \Auth::id()) return;

            $this->get_model()::create([
                'user_id' => $vip['user_id'],
                'vip_given_id' => \Auth::id(),
                'days' => $vip['days']
            ]);
        }



    }
