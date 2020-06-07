<?php


    namespace App\Repositories\Connexion\Gifts;


    use App\Models\Connexion\Gifts\Gifts;
    use App\Repositories\CoreRepository;


    class GiftsRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return Gifts::class;
        }

        /**
         * дать все подарки
         * @return Illuminate\Database\Eloquent\Collection
         */
        public function getAllGiftsWithDeletes(){
            return $this->startCondition()
                        ->withTrashed()
                        ->orderByRaw("price DESC")
                        ->get();
        }

        /**
         * @param $id
         * @return Gifts|null
         */
        public function getByIdGiftsWithDeletes($id){
            return $this->startCondition()
                        ->where('id', $id)
                        ->withTrashed()
                        ->first();
        }

        /**
         * дать все подарки
         * @return Illuminate\Database\Eloquent\Collection
         */
        public function getAllGifts(){
            return $this->startCondition()
                ->select("id", "path", "price",  "title_{$this->local} AS title")
                ->orderByRaw("price ASC")
                ->get();
        }

        /**
         * дать цену подарка по id
         * @param $id
         * @return null|string
         */
        public function getPriceById($id){
            $gift = $this->startCondition()
                         ->select('price')
                         ->where('id', $id)
                         ->first();

            return $gift->price;
        }






    }
