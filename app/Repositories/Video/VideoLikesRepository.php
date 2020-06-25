<?php


    namespace App\Repositories\Video;


    use App\Models\Video\Video;
    use App\Models\Video\VideoLikes;
    use App\Repositories\CoreRepository;
    use Illuminate\Database\Eloquent\Collection;


    class VideoLikesRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return VideoLikes::class;
        }


        /**
         * @param $video_id
         * @return integer
         */
        public function getCountLikeForVideo($video_id){
            $count =  $this->startCondition()
                           ->where('video_id', $video_id)
                           ->count();
            return $count;
        }

        public function getMyLikeCount($video_id){
            $count =   $this->startCondition()
                            ->where([['video_id', $video_id], ['user_id', \Auth::id()]])
                            ->count();
            return $count;
        }

        public function getMyLike($video_id){
            $like =    $this->startCondition()
                            ->where([['video_id', $video_id], ['user_id', \Auth::id()]])
                            ->first();
            return $like;
        }

        public function getLikesWithVideo($user_id){
            $like =    $this->startCondition()
                        ->with([
                            'to_video' => function($query) {
                                $query->select([
                                    'id',
                                    'path_img',
                                    "title_{$this->local} AS title",
                                    "description_{$this->local} AS description"
                                ]);
                            }
                        ])->where('user_id', $user_id)
                        ->orderBy('id', "DESC")
                        ->paginate(30);
            return $like;
        }

















    }
