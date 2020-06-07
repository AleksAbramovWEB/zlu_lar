<?php


    namespace App\Repositories\Connexion\Gifts;



    use App\Models\Connexion\Gifts\GiftsGiven;
    use App\Repositories\CoreRepository;
    use Carbon\Carbon;


    class GiftsGivenRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return GiftsGiven::class;
        }


        /**
         * дать все подарки подаренные пользователю
         *
         * @param $user_id
         * @return Illuminate\Database\Eloquent\Collection
         */
        public function getAllGiftsForUser($user_id){

            $month_ago = Carbon::now()->subMonth();

            $where = [
                ['whom_user_id', $user_id],
                ['created_at', '>' , $month_ago]
            ];

            $with = [
                'to_from_user_id:id,name,birthday,position,gender,avatar',
                'to_gift_id' => function ($query) {
                    $query->select(['id', 'path', "title_{$this->local} AS title"]);
                }
            ];

            $gifts = $this->startCondition()
                          ->select(['gift_id', 'from_user_id', 'not_visible', 'comment'])
                          ->where($where)
                          ->with($with)
                          ->orderByRaw("id DESC")
                          ->get();

            return $gifts;
        }








    }
