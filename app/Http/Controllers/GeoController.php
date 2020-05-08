<?php


    namespace App\Http\Controllers;




    use App\Repositories\Geo\GeoCitiesRepository;
    use App\Repositories\Geo\GeoRegionsRepository;
    use Illuminate\Support\Arr;
    use Illuminate\Support\Collection;

    class GeoController extends Controller
    {

        public function region($country_id, GeoRegionsRepository $geoRegionsRepository ){
            $regions = $geoRegionsRepository->getAllRegionsByCountryId($country_id);
            $regions = $this->refractoryArrayGeo($regions);
            return response()->json($regions);
        }

        public function cities($region_id, GeoCitiesRepository $geoCitiesRepository){
            $cities = $geoCitiesRepository->getAllCitiesByRegionId($region_id);
            $cities = $this->refractoryArrayGeo($cities);
            return response()->json($cities);
        }

        /**
         * готовим данные для отправки в формате json
         * @param Collection $array
         * @return array
         */
        private function refractoryArrayGeo($array){
            $array = $array->toArray();
            $array = Arr::pluck($array, 'title', 'id');
            return $array;
        }

    }
