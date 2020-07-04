<?php


    namespace App\Components\News\FactoriesNews;


    use App\Models\Connexion\News\NewsProfileViews;
    use Carbon\Carbon;

    class ProfileViewsNews extends NewsAbstract
    {

        protected $nameModel = NewsProfileViews::class;
        protected $model = NULL;

        public function addNews($user_id)
        {
            if ($user_id == \Auth::id()) return false;
            if ($this->timeOut($user_id)) return false;

            $this->get_model()::create([
                'user_id' => $user_id,
                'watcher_id' => \Auth::id()
            ]);
        }


        private function timeOut($user_id){

            $lastView = $this->get_model()
                             ->where([
                                 ['user_id', $user_id],
                                 ['watcher_id', \Auth::id()],
                                 ['created_at', '>', Carbon::now()->subMinutes(30)]
                             ])->exists();
            return $lastView;
        }




    }
