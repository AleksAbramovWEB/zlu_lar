<?php


    namespace App\Repositories\Connexion\Messenger;


    use App\Models\Connexion\Messenger\Photos;
    use App\Repositories\CoreRepository;
    use Illuminate\Database\Eloquent\Collection;


    class MessengerPhotosRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return Photos::class;
        }


        /**
         * получить фото для месседжера
         * @return Collection
         */
        public function getAuthUserPhotos(){

            $photos = $this->startCondition()
                           ->where('user_id', \Auth::id())
                           ->orderBy('id', 'DESC')
                           ->get();
            return $photos;
        }

        /**
         * проверить сущесвование по id
         * @param $photo_id
         * @return boolean
         */
        public function existAuthUserPhotoById($photo_id){
            $photos = $this->startCondition()
                           ->where('user_id', \Auth::id())
                           ->where('id', $photo_id)
                           ->exists();

            return $photos;
        }

        /**
         * получить по массиву с id фото
         * @param array $array
         * @return Collection
         */
        public function getAuthUserPhotoByArrayId(array $array){
            $photos = $this->startCondition()
                           ->whereIn('id', $array)
                           ->get();
            return $photos;
        }








    }
