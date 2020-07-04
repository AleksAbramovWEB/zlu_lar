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
         * @param $request
         * @return Collection
         */
        public function getVideoForAdminList($request){

            $columns = ['created_at', 'updated_at', 'deleted_at', 'views', 'published', 'likes'];
            $column = $request->input('column');
            $direction = $request->input('direction');


            $fil_rez = function ($column) use ($direction){
                if ($direction == 'asc') return ['column' => $column, 'direction' => 'DESC'];
                else return ['column' => $column, 'direction' => 'ASC'];
            };

            if (in_array($column, $columns)) $order = $fil_rez($column);
            else $order = ['column' => 'id', 'direction' => 'DESC'];

            $films =  $this->startCondition()
                           ->select([
                               'id',
                               'path_video',
                               'path_img',
                               "title_{$this->local} AS title",
                               "description_{$this->local} AS description",
                               'published',
                               'created_at',
                               'updated_at',
                               "deleted_at",
                               \DB::raw("(SELECT COUNT(*) FROM `video_likes` WHERE `video_id` = `video`.`id`) AS 'likes'")
                           ])->orderBy($order['column'], $order['direction'])
                             ->withTrashed()
                             ->paginate(30);
            return $films;
        }

        public function getVideoByIdWithDeleted($id){
            $film =  $this->startCondition()
                          ->select([\DB::raw("`video`.*, (SELECT COUNT(*) FROM `video_likes` WHERE `video_id` = `video`.`id`) AS 'likes'")])
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

        public function getVideoById($id){

            $where = [
                ['id', $id],
                ['published', 1]
            ];

            $select = [
                'id',
                'path_video',
                'path_img',
                "title_{$this->local} AS title",
                "description_{$this->local} AS description",
                "views"
            ];

            $film =  $this->startCondition()
                          ->select($select)
                          ->where($where)
                          ->with(['to_categories' => function ($query) use ($id) {
                                $query->with(['to_category' => function($query) use ($id){
                                    $query->select(['id', "title_{$this->local} AS title", "slug"]);
                                    // похожие видео
                                    $query->with(['to_videos' => function($query) use ($id){
                                        $query->with(['to_video' => function($query){
                                            $query->select(['id', 'path_img', "title_{$this->local} AS title"])
                                                  ->where('published', 1);
                                        }])->where('video_id','<>', $id)->limit(30);;
                                    }]);
                                }]);
                          }])

                          ->first();
            return $film;
        }


        public function totalStats(){

            $count_video = "SELECT COUNT(*) FROM `video`";
            $count_likes = "SELECT COUNT(*) FROM `video_likes`";
            $views_video = "SELECT SUM(views) FROM `video`";
            $deleted_video = "SELECT COUNT(*) FROM `video` WHERE `deleted_at` is not null";
            $published_video = "SELECT COUNT(*) FROM `video` WHERE `published` = '1'";
            $is_not_published_video = "SELECT COUNT(*) FROM `video` WHERE `published` = '0'";

            $stats = $this->startCondition()
                    ->select([
                        \DB::raw("
                            ($count_video) AS 'count_video',
                            ($count_likes) AS 'count_likes',
                            ($views_video) AS 'views_video',
                            ($deleted_video) AS 'deleted_video',
                            ($published_video) AS 'published_video',
                            ($is_not_published_video) AS 'is_not_published_video'
                        ")
                    ])
                    ->toBase()
                    ->first();

            return $stats;
        }


        public function getVideoForIndex($sortRequest){

            $params = ['views', 'likes', 'created_at'];

            if (in_array($sortRequest, $params)) $sort = $sortRequest;
            else $sort = 'id';

            $films =  $this->startCondition()
                ->select([
                    'id',
                    'path_img',
                    "title_{$this->local} AS title",
                    "description_{$this->local} AS description",
                    'created_at',
                    'views',
                    \DB::raw("(SELECT COUNT(*) FROM `video_likes` WHERE `video_id` = `video`.`id`) AS 'likes'")
                ])
                ->where('published', 1)
                ->orderBy($sort, "DESC")
                ->paginate(30);

            return $films;
        }

        public function getLikesVideoForProfile($user_id){
            $films =  $this->startCondition()
                           ->select(['video.id', 'video.path_img', "video.title_{$this->local} as title"])
                           ->join('video_likes', 'video_likes.video_id', '=', 'video.id')
                           ->where([
                               ['video.published' , '1'],
                               ['video_likes.user_id', $user_id]
                           ])->orderBy('video_likes.id', "DESC")
                             ->limit(20)
                             ->get();

            return $films;
        }
















    }
