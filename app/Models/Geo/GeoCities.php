<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Geo\GeoCities
 *
 * @property int $id
 * @property int $region_id
 * @property string $title_ru
 * @property string $title_en
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleRu($value)
 * @mixin \Eloquent
 */
class GeoCities extends Model
{
    protected $table = 'geo_cities';
}
