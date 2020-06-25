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

        public function getAllCategoriesForIndexVideo(){
            $categories =     $this->startCondition()
                                   ->select(['id', "title_{$this->local} AS title" , 'slug'])
                                   ->where('published', 1)
                                   ->with(['to_videos' => function($query){
                                       $query->with([
                                           'to_video' => function($query){
                                               $query->select(['id','path_img']);
                                           }
                                       ]);
                                    }])->inRandomOrder()
//                                    ->limit(30)
                                    ->get();
            return $categories;

        }

        public function getAllCategoriesVideoExistsIsPublished(){

            $where = $this->getCategoryWhere();

            $categories =     $this->startCondition()
                                   ->select(['id', "title_{$this->local} AS title" , 'slug'])
                                   ->where($where)
                                   ->toBase()
                                   ->get();
            return $categories;
        }

        public function getCategoryBySlugWithVideo($slug, $sortRequest){

            $params = ['views', 'likes', 'created_at'];

            if (in_array($sortRequest, $params)) $sort = $sortRequest;
            else $sort = 'id';

            $where = $this->getCategoryWhere();

            $category =        $this->startCondition()
                                    ->select(['id', "title_{$this->local} AS title", 'slug'])
                                    ->where($where)
                                    ->where('slug', $slug)
                                    ->with(['to_videos' => function($query) use ($sort){
                                        $query->with([
                                            'to_video' => function($query){
                                                $query->select([
                                                    'id',
                                                    'path_img',
                                                    "title_{$this->local} AS title",
                                                    "description_{$this->local} AS description"
                                                ]);
                                            }
                                        ])->select([
                                            'video_id',
                                            'category_id',
                                            \DB::raw("(SELECT COUNT(*) FROM `video_likes` WHERE `video_id` = `video`.`id`) AS 'likes'")
                                        ])->join('video', 'video.id', '=', 'video_category_unite.video_id')
                                        ->orderBy($sort, "DESC")
                                        ->paginate(30);
                                    }])->first();

            return $category;
        }


        private function getCategoryWhere(){
            return   [
                        ['published', 1],
                        [function ($query){
                            $query->select(\DB::raw('count(*)'))
                                ->from('video')
                                ->join('video_category_unite', 'video_category_unite.video_id', '=', 'video.id')
                                ->where('published', 1)
                                ->whereColumn('video_category_unite.category_id', 'video_categories.id')
                                ->limit(1);
                        }, '>', 0]
                    ];
        }

















    }
