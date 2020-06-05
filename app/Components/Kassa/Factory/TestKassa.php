<?php


    namespace App\Components\Kassa\Factory;


    use Illuminate\Http\Request;

    class TestKassa extends AbstractFactoryKassa
    {
        protected $kassa_name = 'test';

        protected $kassa_currency = 'RUB';



        public function send_to_the_kassa($coins)
        {

            $this->model_kassa->cash = md5(\Auth::id().$this->kassa_name.$this->price[$coins].time());
            $this->model_kassa->coins = $coins;
            $this->model_kassa->sum_money = $this->price[$coins];
            $this->model_kassa->save();

            return redirect()->route( 'kassa.test' ,[
                'order' => $this->model_kassa->id,
                'hash'  => $this->model_kassa->cash
             ]);

        }

        public function get_from_the_kassa(Request $request)
        {

            $order = $this->model_kassa->find($request->order);

            if ($order->cash !== $request->hash or $order->status == 1) return false;


            $user = $this->model_user->find($order->user_id);
            $user->coins = $user->coins + $order->coins;
            $user->save();

            $order->status = 1;
            $order->save();

            return true;

        }


    }
