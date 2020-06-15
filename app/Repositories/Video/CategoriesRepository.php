<?php


    namespace App\Repositories\Video;


    use App\Models\Video\CategoriesVideo;
    use App\Repositories\CoreRepository;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Http\Request;


    class CategoriesRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return CategoriesVideo::class;
        }


        /**
         * получить для админ листа
         * @param $request
         * @return Collection
         */
        public function getCategoriesForAdminListWithDeleted(Request $request){
            $columns = ['id', 'slug', 'title_ru', 'title_en', 'published'];
            $column = $request->input('column');
            $direction = $request->input('direction');


            $fil_rez = function ($column) use ($direction){
                if ($direction == 'asc') return ['column' => $column, 'direction' => 'ASC'];
                else return ['column' => $column, 'direction' => 'DESC'];
            };

            if (in_array($column, $columns)) $order = $fil_rez($column);
            else $order = ['column' => 'id', 'direction' => 'ASC'];


            $categories =     $this->startCondition()
                                   ->orderBy($order['column'], $order['direction'])
                                   ->withTrashed()
                                   ->get();
            return $categories;
        }


        public function getAllCategories(){
            $categories =     $this->startCondition()
                                   ->select(['id', "title_{$this->local} AS title"])
                                   ->orderBy("title_{$this->local}", 'ASC')
                                   ->get();
            return $categories;
        }

        public function getCategoryByIdWithDeleted($id){
            $category =     $this->startCondition()
                                 ->where('id', $id)
                                 ->withTrashed()
                                 ->first();
            return $category;
        }
















    }
