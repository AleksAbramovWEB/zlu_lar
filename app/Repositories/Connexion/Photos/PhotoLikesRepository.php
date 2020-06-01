<?php


    namespace App\Repositories\Connexion\Photos;


    use App\Models\Connexion\Photos\Photos;
    use App\Models\Connexion\Photos\PhotosLikes;
    use App\Repositories\CoreRepository;
    use Illuminate\Database\Eloquent\Collection;


    class PhotoLikesRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return PhotosLikes::class;
        }


        /**
         * получить количество лайков для фото
         * @param $photo_id
         * @return int
         */
        public function getCountLikesForPhoto($photo_id){

            $photos = $this->startCondition()
                           ->where('photo_id', $photo_id)
                           ->count();
            return $photos;
        }

        /**
         * @param $photo_id
         * @return boolean
         */
        public function existsMyLikeForPhoto($photo_id){
            $bool = $this->startCondition()
                ->where([['photo_id', $photo_id], ['user_id', \Auth::id()]])
                ->exists();

            return $bool;
        }

        public function getUserLikeForPhoto($photo_id){
            $like = $this->startCondition()
                ->where([['photo_id', $photo_id], ['user_id', \Auth::id()]])
                ->first();

            return $like;
        }













    }
