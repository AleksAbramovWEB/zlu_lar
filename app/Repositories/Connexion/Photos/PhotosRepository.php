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











    }
