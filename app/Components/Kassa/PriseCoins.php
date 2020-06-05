<?php


    namespace App\Components\Kassa;


    use App\Exceptions\Kassa\CurrencyNotFoundException;

    class PriseCoins
    {

        //цена 1 коина в рублях без скидки
        const COIN = 30;

        // курс валют по умолчанию
        private $currencies = [
            'USD' => 60
        ];

        // скидочный кофициент
        private $discount = 0.1;

        // количество вариатов покупки коинов по количеству
        private $bay_coins = [1, 5, 10, 20, 40, 80];



        public function __construct()
        {
            $this->get_currencies();
        }



        public function get_prise($currency){
            $discount = 0;
            $price = [];
            if($currency == 'RUB'){
                foreach ($this->bay_coins as $buyCoin) {
                    $price[$buyCoin] = round(($buyCoin * self::COIN) - (($buyCoin * self::COIN) * $discount), 2);
                    $discount = $discount + $this->discount;
                }
            }else{

                if (empty($this->currencies[$currency])) throw new CurrencyNotFoundException();

                foreach ($this->bay_coins as $buyCoin) {
                    $price[$buyCoin] = round(
                        (($buyCoin * self::COIN) / $this->currencies[$currency]) -
                        ((($buyCoin * self::COIN) / $this->currencies[$currency]) * $this->discount), 2);
                    $discount = $discount + $this->discount;
                }
            }
            $return['currency'] = $currency;
            $return['prise'] = $price;

            return $return;
        }


        public function exists_bay_coins($coins){
            return in_array($coins, $this->bay_coins);
        }


        // получение курса валют
        private function get_currencies() {

            if (!\MainHelper::exist_url('http://cbr.ru/scripts/XML_daily.asp')) return;

            $xml = simplexml_load_file('http://cbr.ru/scripts/XML_daily.asp');

            foreach ($xml->xpath('//Valute') as $val)
                $this->currencies[(string)$val->CharCode] = (float)str_replace(',', '.', $val->Value);

        }



    }
