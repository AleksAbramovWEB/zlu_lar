<?php


    namespace App\Repositories\Video;


    use App\Models\Video\Video;
    use App\Repositories\CoreRepository;
    use Illuminate\Database\Eloquent\Collection;


    class VideoRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return Video::class;
        }


        /**
         * получить для админ листа
         * @return Collection
         */
        public function getVideoForAdminList(){
            $films =  $this->startCondition()
                           ->select(['id', 'path_video', 'path_img', "title_{$this->local} AS title", "description_{$this->local} AS description", "deleted_at"])
                           ->orderBy('id', 'DESC')
                           ->withTrashed()
                           ->paginate(30);
            return $films;
        }

        public function getVideoByIdWithDeleted($id){
            $film =  $this->startCondition()
                          ->where('id', $id)
                          ->with(['to_categories' => function ($query) {
                                $query->with(['to_category' => function($query){
                                    $query->select(['id', "title_{$this->local} AS title"]);
                                }]);
                          }])
                          ->withTrashed()
                          ->first();
            return $film;
        }














    }
