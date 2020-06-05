<?php


    namespace App\Components\Kassa;


    use App\Components\Kassa\factories\AbstractFactoryKassa;
    use App\Exceptions\Kassa\KassaNotFoundException;
    use Illuminate\Http\Request;


    class Kassa
    {
        /**
         * @var AbstractFactoryKassa
         */
        private $factoryKassa;

        private $configKasses;

        private $prise;

        public function __construct()
        {
            $this->configKasses = config('kasses');

        }

        /**
         * получение абстрактнай фабрики определенной платежной системы
         * подготовка и отпрака запроса к платежной системе
         * @param Request $request
         * @return mixed
         * @throws KassaNotFoundException
         */
        public function send_to_the_kassa(Request $request)
        {
            $this->getFactoryKassa($request->name_kassa);

            return $this->factoryKassa->send_to_the_kassa($request->coins);
        }

        /**
         * получение абстрактнай фабрики определенной платежной системы
         * обратная связь от платежной системы
         * @param \Request $request
         * @param string   $name_kassa имя фабрики
         * @return mixed
         * @throws KassaNotFoundException
         */
        public function get_from_the_kassa(Request $request, $name_kassa)
        {
            $this->getFactoryKassa($name_kassa);

            return $this->factoryKassa->get_from_the_kassa($request);
        }

        /**
         * создать абстрактную фабрику
         * @param string $kassa имя фабрики
         * @throws KassaNotFoundException
         */
        private function getFactoryKassa($kassa){
            $kassa = $this->configKasses[$kassa]['factory'];
            if (!class_exists($kassa)) throw new KassaNotFoundException();
            $this->factoryKassa = new $kassa;
        }


        public function get_prise_for_view(){
             $currency = (\App::getLocale() == 'ru') ? 'RUB' : 'USD';
             return (new PriseCoins())->get_prise($currency);
        }

        public function get_kasses_view(){
            return $this->configKasses;
        }

    }
