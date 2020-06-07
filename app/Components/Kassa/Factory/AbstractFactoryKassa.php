<?php


    namespace App\Components\Kassa\Factory;


    use App\Components\Kassa\PriseCoins;
    use App\Models\Kassa;
    use App\Models\User;
    use Illuminate\Http\Request;

    abstract class AbstractFactoryKassa
    {
        /**
         * @var Kassa
         */
        protected $model_kassa;

        /**
         * @var User
         */
        protected $model_user = NULL;

        protected $kassa_name;

        protected $kassa_currency = 'RUB';

        protected $price;

        public function __construct()
        {

            $this->model_kassa = new Kassa();
            $this->model_kassa->user_id = \Auth::id();
            $this->model_kassa->name = $this->kassa_name;

            $this->price = (new PriseCoins())->get_prise($this->kassa_currency)['prise'];

        }

        protected function get_user(){
            if ($this->model_user === NULL)
                $this->model_user = new User();
            return $this->model_user;
        }

        abstract public function send_to_the_kassa($coins);

        abstract public function get_from_the_kassa(Request $request);


    }
