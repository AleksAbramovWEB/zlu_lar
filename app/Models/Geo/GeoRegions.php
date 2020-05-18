<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Geo\GeoRegions
 *
 * @property int $id
 * @property int $country_id
 * @property string $title_ru
 * @property string $title_en
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleRu($value)
 * @mixin \Eloquent
 */
class GeoRegions extends Model
{
    protected $table = 'geo_regions';
}
