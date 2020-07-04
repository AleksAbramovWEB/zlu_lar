<?php


    namespace App\Repositories\Connexion;


    use App\Models\User;
    use App\Repositories\CoreRepository;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Request;

    class UserRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return User::class;
        }

        /**
         * @param $id integer
         * @return Illuminate\Database\Eloquent\Collection
         */
        public function getUserElById($id){
            return $this->startCondition()
                        ->where('id', $id)
                        ->first();
        }

        /**
         * поисковая выборка
         * @param Request $request
         * @return Illuminate\Database\Eloquent\Collection
         */
        public function getUsersElForSearch($request){

            $where = [];
            $where[] = ['id', '<>' ,\Auth::id()];
            if ($request->gender) $where[] = ['gender', '=' , $request->gender];
            if ($request->position) $where[] = ['position', '=' , $request->position];
            if ($request->age_from){
                $date = date((date('Y') - $request->age_from - 1) . '-m-d');
                $where[] = ['birthday', '<=' , $date];
            }if ($request->age_to){
                $date = date((date('Y') - $request->age_to) . '-m-d');
                $where[] = ['birthday', '>=' , $date];
            }if ($request->country) $where[] = ['country', '=' , $request->country];
            if ($request->region) $where[] = ['region', '=' , $request->region];
            if ($request->city) $where[] = ['city', '=' , $request->city];
            if ($request->user_online){
                $minutes_ago = Carbon::now()->subMinutes(15)->toDateTimeString();
                $where[] = ['last_time', '>', $minutes_ago];
            }if ($request->with_photos) $where[] = ['avatar', '<>', NULL];
            if ($request->vip){
                $now = Carbon::now()->toDateTimeString();
                $where[] = ['vip', '>', $now];
            }

            $geo_query = function ($query) {
                $query->select(['id', "title_{$this->local} AS title"]);
            };

            $fields = ['id', 'name', 'birthday', 'position', 'gender', 'avatar', 'greeting', 'last_time', 'country', 'region', 'city'];

            $users = $this->startCondition()
                          ->select($fields)
                          ->where($where)
                          ->orderBy('id', 'DESC')
                          ->with([
                              "geo_country" => $geo_query,
                              "geo_region" => $geo_query,
                              "geo_city" => $geo_query,
                          ])
                          ->paginate(20);

            return $users;
        }

        public function getNameById($id){
            $users = $this->startCondition()
                          ->select('name')
                          ->where('id', $id)
                          ->toBase()
                          ->first();

            return $users->name;

        }





    }
