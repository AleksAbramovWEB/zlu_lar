<?php


    namespace App\Components\News;


    use Illuminate\Pagination\LengthAwarePaginator;

    class SelectNews
    {
        private $news;
        private $user_id;

        public function __construct($user_id = null)
        {
            if (is_null($user_id)) $this->user_id = \Auth::id();
            else $this->user_id = $user_id;

            $this->news =  $this->comment_photo()
                                ->union($this->gifts_given())
                                ->union($this->vip_given())
                                ->union($this->likes_photo())
                                ->union($this->profile_views())
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);
        }


        public function getNews(){
            return $this->news;
        }

        private function comment_photo(){

            $json = \DB::raw( "CONCAT_WS('\"', '{'
            '\"comment_id\":', `news_comment_photo`.`comment_id`, ', '
            '\"user_id\":', `users`.`id`, ', '
            '\"user_name\":', `users`.`name`, ', '
            '\"user_avatar\":', `users`.`avatar`, ', '
            '\"user_position\":', `users`.`position`, ', '
            '\"user_gender\":', `users`.`gender`, ', '
            '\"photos_id\":', `photos`.`id`, ', '
            '\"photos_path\":', `photos`.`path`, '}'
            ) as 'parameters'");


            return \DB::table('news_comment_photo')
                        ->select([
                            \DB::raw("'comment_photo' as 'news'"),
                            'news_comment_photo.id',
                            $json,
                            'news_comment_photo.views',
                            'photos_comment.created_at'
                        ])->join('photos_comment', 'news_comment_photo.comment_id', '=', 'photos_comment.id')
                          ->join('users', 'users.id', '=', 'photos_comment.user_id')
                          ->join('photos', 'photos.id', '=', 'photos_comment.photo_id')
                          ->where('news_comment_photo.user_id', $this->user_id);
        }

        private function likes_photo(){
            $json = \DB::raw( "CONCAT_WS('\"', '{'
            '\"like_id\":', `news_likes_photo`.`like_id`, ', '
            '\"user_id\":', `users`.`id`, ', '
            '\"user_name\":', `users`.`name`, ', '
            '\"user_avatar\":', `users`.`avatar`, ', '
            '\"user_position\":', `users`.`position`, ', '
            '\"user_gender\":', `users`.`gender`, ', '
            '\"photos_id\":', `photos`.`id`, ', '
            '\"photos_path\":', `photos`.`path`, '}'
            ) as 'parameters'");


            return \DB::table('news_likes_photo')
                ->select([
                    \DB::raw('"likes_photo" as "news"'),
                    'news_likes_photo.id',
                    $json,
                    'news_likes_photo.views',
                    'photos_likes.created_at'
                ])->join('photos_likes', 'news_likes_photo.like_id', '=', 'photos_likes.id')
                ->join('users', 'users.id', '=', 'photos_likes.user_id')
                ->join('photos', 'photos.id', '=', 'photos_likes.photo_id')
                ->where('news_likes_photo.user_id', $this->user_id);
        }

        private function gifts_given(){
            $local = \App::getLocale();
            $json = \DB::raw( "CONCAT_WS('', '{'
            '\"gifts_given_id\": \"', `gifts_given`.`id`, '\", '
            '\"gifts_comment\": \"', `gifts_given`.`comment`, '\", '
            '\"user_id\": \"', `users`.`id`, '\", '
            '\"user_name\": \"', `users`.`name`, '\", '
            '\"user_avatar\": \"', `users`.`avatar`, '\", '
            '\"user_position\": \"', `users`.`position`, '\", '
            '\"user_gender\": \"', `users`.`gender`, '\", '
            '\"gifts_title\": \"', `gifts`.`title_$local`, '\", '
            '\"gifts_path\": \"', `gifts`.`path`, '\"}'
            ) as 'parameters'");

            return \DB::table('news_gifts_given')->select([
                        \DB::raw('  "gifts_given" as "news" '),
                        'news_gifts_given.id',
                        $json,
                        'news_gifts_given.views',
                        'gifts_given.created_at'
                    ])->join('gifts_given', 'news_gifts_given.gifts_given_id', '=', 'gifts_given.id')
                      ->join('users', 'users.id', '=', 'gifts_given.from_user_id')
                      ->join('gifts', 'gifts.id', '=', 'gifts_given.gift_id')
                      ->where('news_gifts_given.user_id', $this->user_id);

        }

        private function vip_given(){

            $json = \DB::raw( "CONCAT_WS('\"', '{'
            '\"days\":', `news_vip_given`.`days`, ', '
            '\"user_id\":', `users`.`id`, ', '
            '\"user_name\":', `users`.`name`, ', '
            '\"user_avatar\":', `users`.`avatar`, ', '
            '\"user_position\":', `users`.`position`, ', '
            '\"user_gender\":', `users`.`gender`,  '}'
            ) as 'parameters'");

            return \DB::table('news_vip_given')->select([
                        \DB::raw('  "vip_given" as "news"'),
                        'news_vip_given.id',
                        $json,
                        'news_vip_given.views',
                        'news_vip_given.created_at'
                    ])->join('users', 'users.id', '=', 'news_vip_given.vip_given_id')
                      ->where('news_vip_given.user_id', $this->user_id);

        }

        private function profile_views(){

            $json = \DB::raw( "CONCAT_WS('\"', '{'
            '\"user_id\":', `users`.`id`, ', '
            '\"user_name\":', `users`.`name`, ', '
            '\"user_avatar\":', `users`.`avatar`, ', '
            '\"user_position\":', `users`.`position`, ', '
            '\"user_gender\":', `users`.`gender`,  '}'
            ) as 'parameters'");

            return \DB::table('news_profile_views')->select([
                        \DB::raw('  "profile_views" as "news" '),
                        'news_profile_views.id',
                        $json,
                        'news_profile_views.views',
                        'news_profile_views.created_at'
                    ])->join('users', 'users.id', '=', 'news_profile_views.watcher_id')
                      ->where('news_profile_views.user_id', $this->user_id);

        }


    }
