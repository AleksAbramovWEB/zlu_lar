<?php


    namespace App\Components;


    class Declination
    {

        public function hours($value){
            $words = [ __('declination.hour_1'),__('declination.hour_2'),__('declination.hour_3'), ];
            return self::num_word($value, $words);
        }
        public function users($value){
            $words = [ __('declination.user_1'),__('declination.user_2'),__('declination.user_3'), ];
            return self::num_word($value, $words);
        }

        public function contacts($value){
            $words = [ __('declination.contact_1'),__('declination.contact_2'),__('declination.contact_3'), ];
            return self::num_word($value, $words);
        }

        public function coins_bay($value){
            $words = [ __('declination.coins_buy_1'),__('declination.coins_buy_2'),__('declination.coins_buy_3'), ];
            return self::num_word($value, $words);
        }

        public function coins($value){
            $words = [ __('declination.coins_1'),__('declination.coins_2'),__('declination.coins_3'), ];
            return self::num_word($value, $words);
        }

        public function days($value){
            $words = [ __('declination.days_1'),__('declination.days_2'),__('declination.days_3'), ];
            return self::num_word($value, $words);
        }

        public function minutes($value){
            $words = [ __('declination.minutes_1'),__('declination.minutes_2'),__('declination.minutes_3'), ];
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
