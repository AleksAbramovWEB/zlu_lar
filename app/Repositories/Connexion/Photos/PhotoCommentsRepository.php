<?php


    namespace App\Repositories\Connexion\Photos;


    use App\Models\Connexion\Photos\Photos;
    use App\Models\Connexion\Photos\PhotosComment;
    use App\Repositories\CoreRepository;
    use Illuminate\Database\Eloquent\Collection;


    class PhotoCommentsRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return PhotosComment::class;
        }


        /**
         * получить коменты к фото
         *
         * @param $photo_id
         *
         * @return Collection
         */
        public function getCommentsForPhoto($photo_id){
            $photos = $this->startCondition()
                           ->where('photo_id', $photo_id)
                           ->with('to_user_id:id,name,birthday,position,gender,avatar,last_time')
                           ->orderBy('id', 'DESC')
                           ->paginate(20);
            return $photos;
        }













    }
