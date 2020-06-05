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

        public function exist_url($url){
            $urlHeaders = get_headers($url);
// проверяем ответ сервера на наличие кода: 200 - ОК
            if(strpos($urlHeaders[0], '200')) return true;
            else return false;
        }

        /**
         * Получить ссылку на фаил s3
         * @param $path string путь на диске s3
         * @return string
         */
        public function getFileS3($path){
            $client = \Storage::disk('s3')->getDriver()->getAdapter()->getClient();
            $bucket = \Config::get('filesystems.disks.s3.bucket');
            $command = $client->getCommand('GetObject', [
                'Bucket' => $bucket,
                'Key' => $path  // file name in s3 bucket which you want to access
            ]);
            $request = $client->createPresignedRequest($command, '+20 minutes');

            return  (string)$request->getUri();

        }


    }
