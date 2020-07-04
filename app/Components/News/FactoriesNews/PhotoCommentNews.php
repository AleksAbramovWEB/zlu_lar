<?php


    namespace App\Components\News\FactoriesNews;


    use App\Exceptions\Connexion\News\ParamIsNotObject;
    use App\Models\Connexion\News\NewsCommentPhoto;
    use App\Models\Connexion\Photos\PhotosComment;

    class PhotoCommentNews extends NewsAbstract
    {
        protected $nameModel = NewsCommentPhoto::class;
        protected $model = NULL;
        /**
         * @param PhotosComment $data
         */
        public function addNews($data)
        {
            if (!is_object($data)) throw new ParamIsNotObject();

            $owner_photo_id = $data->to_photo_id->user_id;
            if ($owner_photo_id == \Auth::id()) return;

            $this->get_model()::create([
                'user_id' => $owner_photo_id,
                'comment_id' => $data->id
            ]);
        }

    }
