<?php


    namespace App\Components;




    class MainHelper
    {

        /**
         * Для валидии форм bootstrap
         *
         * Illuminate\Contracts\Support\MessageBag $errors
         * @param string $field
         * @return null|string
         */
         public function is_valid_form($field)
         {
            if(is_null(session('errors'))) return NULL;
            $errors = session()->get('errors')->getBags()['default']->getMessages();
            if (empty($errors[$field])) return 'is-valid';
            else return 'is-invalid';
        }

        public function option_days()
        {
            $days = [];
            for ($i=1; $i <10 ; $i++) $days[$i] = '0'.$i;
            for ($i=10; $i <32 ; $i++) $days[$i] = $i;
            return $days;
        }

        public function option_months(){
            $months = [];
            $months_key = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
            foreach ($months_key AS $key => $val)
                $months[$key + 1] = "months.$val";
            return $months;
        }

        public function option_years(){
             $years = [];
             $yearUntil = date("Y") - 19;
             $yearTo= date("Y") - 90;
                for ($i = $yearUntil; $i >= $yearTo ; $i--)
                    $years[$i] =  $i;
             return $years;

        }

        public function sanINT($int){
            return (int)filter_var(($int), FILTER_SANITIZE_NUMBER_INT);
        }

    }
