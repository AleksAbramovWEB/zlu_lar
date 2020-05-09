<?php


    namespace App\Repositories\Geo;


    use App\Models\Geo\GeoRegions;
    use App\Repositories\CoreRepository;
    use Illuminate\Support\Collection;


    class GeoRegionsRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return GeoRegions::class;
        }

        /**
         * выбрать все регионы по id страны
         *
         * @param $country_id
         *
         * @return Collection
         */
        public function getAllRegionsByCountryId($country_id){
            if (empty($country_id)) return NULL;
            return $this->startCondition()
                        ->select("region_id as id", "title_{$this->local} AS title")
                        ->where('country_id', $country_id)
                        ->orderByRaw("title_{$this->local} ASC")
                        ->toBase()
                        ->get();
        }
    }
