<?php


    namespace App\Repositories\Connexion\Messenger;


    use App\Models\Connexion\Messenger\Contacts;
    use App\Repositories\CoreRepository;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Request;

    class MessengerContactsRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return Contacts::class;
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
