<?php


    namespace App\Repositories\Geo;


    use App\Models\Geo\GeoCities;
    use App\Repositories\CoreRepository;
    use Illuminate\Support\Collection;


    class GeoCitiesRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return GeoCities::class;
        }

        /**
         * выбрать все города по id региона
         *
         * @param $region_id
         *
         * @return Collection
         */
        public function getAllCitiesByRegionId($region_id){
            return $this->startCondition()
                        ->select("city_id as id", "title_{$this->local} AS title")
                        ->where('region_id', $region_id)
                        ->orderByRaw("title_{$this->local} ASC")
                        ->toBase()
                        ->get();
        }
    }
