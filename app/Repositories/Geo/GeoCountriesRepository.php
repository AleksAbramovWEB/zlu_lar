<?php


    namespace App\Repositories\Geo;


    use App\Models\Geo\GeoCountries;
    use App\Repositories\CoreRepository;
    use Illuminate\Support\Collection;


    class GeoCountriesRepository extends CoreRepository
    {

        protected function getModelClass()
        {
            return GeoCountries::class;

        }

        /**
         * выбрать все страны с id и title в независимости от локализации
         * @return Collection
         */
        public function getAllCountries(){
            return $this->startCondition()
                        ->select("country_id as id", "title_{$this->local} AS title")
                        ->orderByRaw("title_{$this->local} ASC")
                        ->toBase()
                        ->get();
        }
    }
