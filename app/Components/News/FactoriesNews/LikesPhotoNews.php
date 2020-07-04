<?php


    namespace App\Components\News\FactoriesNews;


    use App\Exceptions\Connexion\News\ParamIsNotObject;
    use App\Models\Connexion\News\NewsLikesPhoto;
    use App\Models\Connexion\Photos\PhotosLikes;

    class LikesPhotoNews extends NewsAbstract
    {

        protected $nameModel = NewsLikesPhoto::class;
        protected $model = NULL;

        /**
         * @param PhotosLikes $data
         */
        public function addNews($data)
        {
            $owner_photo_id = $data->to_photo_id->user_id;
            if ($owner_photo_id == \Auth::id()) return;

            $this->get_model()::create([
                'user_id' => $owner_photo_id,
                'like_id' => $data->id
            ]);
        }



    }
