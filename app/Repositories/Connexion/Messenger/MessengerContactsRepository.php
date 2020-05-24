<?php


    namespace App\Repositories\Connexion\Messenger;


    use App\Exceptions\Connexion\Messenger\CategoryNotFoundException;
    use App\Models\Connexion\Messenger\Contacts;
    use App\Repositories\CoreRepository;



    class MessengerContactsRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return Contacts::class;
        }

        /**
         * получить количество контактов по каждой категории
         * @return Illuminate\Support\Collection
         */
        public function countContactsForAllLists(){

            $user_id = \Auth::id();

            $query = function ($category) use ($user_id){
                return "(SELECT count(*) FROM `messenger_contacts`
                         WHERE `user_id` = '$user_id' AND `category` = '$category'
                         AND 0 < ( SELECT count(*) FROM `messenger_messages`
                         WHERE `contact_from` = `messenger_contacts`.`id`
                         OR  `contact_to` = `messenger_contacts`.`id`)
                         )AS count_$category";
            };


            $counts =  $this->startCondition()
                            ->select([
                                \DB::raw("
                                {$query('main_list')},
                                {$query('list_of_favorites')},
                                {$query('black_list')}"),
                            ])->toBase()
                            ->first();
            return $counts;
        }

        /**
         * выборка листов категорий
         * @param $param string тип категории
         * @return Illuminate\Database\Eloquent\Collection
         * @throws CategoryNotFoundException
         */
        public function getListContacts($param)
        {
            $lists = ['main_list', 'list_of_favorites', 'black_list'];

            if (!in_array($param, $lists)) throw new CategoryNotFoundException();

            $where = [
                ['user_id', \Auth::id()],
                ['category', $param]
            ];

            $geo_query = function ($query) {
                $query->select(['id', "title_{$this->local} AS title"]);
            };

            $to_user_contact_query = function ($query) use ($geo_query) {
                $query->with([
                    "geo_country" => $geo_query,
                    "geo_region" => $geo_query,
                    "geo_city" => $geo_query,
                ]);
            };

            $count_message =        "(SELECT COUNT(*) FROM `messenger_messages`
                                    WHERE  `messenger_messages`.`contact_from` = `messenger_contacts`.`id`
                                    OR `messenger_messages`.`contact_to` = `messenger_contacts`.`id`) AS count_messages";

            $count_new_message =    "(SELECT COUNT(*) FROM `messenger_messages`
                                    WHERE  `messenger_messages`.`contact_to` = `messenger_contacts`.`id`
                                    AND  `messenger_messages`.`viewed` = 0) AS count_new_messages";

            $result = $this->startCondition()
                      ->select(\DB::raw("`messenger_contacts`.*, $count_message, $count_new_message"))
                      ->where($where)
                      ->where( function ($query){
                           $query->select(\DB::raw('count(*)'))
                                 ->from('messenger_messages')
                                 ->whereColumn('messenger_messages.contact_from', 'messenger_contacts.id')
                                 ->orWhereColumn('messenger_messages.contact_to', 'messenger_contacts.id')
                                 ->limit(1);
                      }, '>', 0)
                      ->with( ['to_user_contact' => $to_user_contact_query])
                      ->orderBy('updated_at', 'DESC')
                      ->paginate(20);

            return $result;
        }




        /**
         * Получить id контакта с пользователем если он существует
         * @param $user_id
         * @return null|integer
         */
        public function GetIdContactByUserId($user_id){
            $result =    $this->startCondition()
                         ->select('id')
                         ->where([['user_id', \Auth::id()], ['user_contact', $user_id]])
                         ->toBase()
                         ->first();
            if (empty($result)) return NULL;
            else return $result->id;
        }

        public function getContactByIdForContactView($contact_id){

            $where = [
                ['id', $contact_id],
                ['user_id', \Auth::id()]
            ];

            $contact = $this->startCondition()
                       ->where($where)
                       ->with('to_user_contact:id,name,country,region,city,birthday,position,gender,avatar,last_time')
                       ->first();
            return $contact;
        }

        /**
         * получаем контакт по id
         * @param $contact_id
         * @return mixed
         */
        public function getContactStdById($contact_id){

            $where = [
                ['id', $contact_id],
                ['user_id', \Auth::id()]
            ];

            $contact = $this->startCondition()
                       ->where($where)
                       ->toBase()
                       ->first();
            return $contact;
        }


        public function getContactStdByUserId($user_contact){
            $where = [
                ['user_id', $user_contact],
                ['user_contact', \Auth::id()]
            ];

            $contact = $this->startCondition()
                       ->where($where)
                       ->toBase()
                       ->first();
            return $contact;
        }








    }
