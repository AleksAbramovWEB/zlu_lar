<?php


    namespace App\Repositories\Connexion\Photos;


    use App\Models\Connexion\Photos\Photos;
    use App\Repositories\CoreRepository;
    use Illuminate\Database\Eloquent\Collection;


    class PhotosRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return Photos::class;
        }


        /**
         * получить фото
         * @return Collection
         */
        public function getAuthUserPhotos(){

            $photos = $this->startCondition()
                           ->where('user_id', \Auth::id())
                           ->orderBy('id', 'DESC')
                           ->paginate(30);
            return $photos;
        }

        /**
         * получить фото для пользователя
         * @param $user_id
         * @return Collection
         */
        public function getUserPhotosById($user_id){

            $photos = $this->startCondition()
                           ->where('user_id', $user_id)
                           ->orderBy('id', 'DESC')
                           ->paginate(30);
            return $photos;
        }



        public function getPhotoById($id){
            $photo = $this->startCondition()
                          ->where('id', $id)
                          ->first();
            return $photo;
        }

        public function existOwnerPhotoById($id)
        {
            $where = [
                ['id', $id],
                ['user_id', \Auth::id()]
            ];

            $bool = $this->startCondition()
                         ->where($where)
                         ->exists();
            return $bool;

        }

        public function getPhotoByUserId($user_id)
        {
            $photos = $this->startCondition()
                           ->select(['id', 'path'])
                           ->where('user_id', $user_id)
                           ->orderBy('id', 'DESC')
                           ->limit(20)
                           ->get();
            return $photos;
        }











    }
