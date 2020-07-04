<?php


    namespace App\Components\News;

    use App\Components\News\FactoriesNews\GiftsGivenNews;
    use App\Components\News\FactoriesNews\LikesPhotoNews;
    use App\Components\News\FactoriesNews\PhotoCommentNews;
    use App\Components\News\FactoriesNews\ProfileViewsNews;
    use App\Components\News\FactoriesNews\VipGivenNews;
    use App\Exceptions\Connexion\News\NewsAddClassNotFound;


    class News
    {
        private $typeNews = [
            'likes_photo' => LikesPhotoNews::class,
            'comment_photo' => PhotoCommentNews::class,
            'profile_views' => ProfileViewsNews::class,
            'gifts_given' => GiftsGivenNews::class,
            'vip_given' => VipGivenNews::class
        ];


        public function addNews($type, $data){
            if (!\Auth::hasUser()) return false;
            $this->getFactoryNews($type)->addNews($data);
        }

        public function getNews($user_id = NULL){
            $news = (new SelectNews($user_id))->getNews();
            $this->updateViews($news);
            return $news;
        }


        private function updateViews($news){
            $no_views = [];
            foreach ($news as $new)
                if ($new->views === 0) $no_views[$new->news][] = $new->id;
            if (!empty($no_views))
                foreach ($no_views as $key => $val)
                    $this->getFactoryNews($key)->updateViews($val);
        }

        private function getFactoryNews($type){
            $class = $this->typeNews[$type];
            if (!class_exists($class)) throw new NewsAddClassNotFound();
            return new $class;
        }


    }
