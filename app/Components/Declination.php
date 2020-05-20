<?php


    namespace App\Components;


    class Declination
    {

//
//        public function days($value){
//            $words = ['ru' => ['день', 'дня', 'дней'], 'en' => ['day','days','days' ]];
//            return self::num_word($value, $words[\App::getLocale()]);
//        }
//
//        public function view($value){
//            $words = ['ru' => ['просмотр', 'просмотра', 'просмотров'], 'en' => ['view','views','views' ]];
//            return self::num_word($value, $words[\App::getLocale()]);
//        }
//
//        public function time($value){
//            $words = ['ru' => ['раз', 'раза', 'раз'], 'en' => ['time','times','times' ]];
//            return self::num_word($value, $words[\App::getLocale()]);
//        }

        public function hours($value){
            $words = [ __('declination.hour_1'),__('declination.hour_2'),__('declination.hour_3'), ];
            return self::num_word($value, $words[]);
        }
        public function users($value){
            $words = [ __('declination.user_1'),__('declination.user_3'),__('declination.user_3'), ];
            return self::num_word($value, $words);
        }




        private function num_word($value, $words, $show = true)
        {
            $num = $value % 100;
            if ($num > 19) {
                $num = $num % 10;
            }

            $out = ($show) ?  $value . ' ' : '';
            switch ($num) {
                case 1:  $out .= $words[0]; break;
                case 2:
                case 3:
                case 4:  $out .= $words[1]; break;
                default: $out .= $words[2]; break;
            }
            return $out;
        }

    }
