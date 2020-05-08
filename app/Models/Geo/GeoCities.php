<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geo\GeoCities
 *
 * @property int $city_id
 * @property int $country_id
 * @property int $region_id
 * @property string|null $title_ru
 * @property string|null $title_ua
 * @property string|null $title_be
 * @property string|null $title_en
 * @property string|null $title_es
 * @property string|null $title_pt
 * @property string|null $title_de
 * @property string|null $title_fr
 * @property string|null $title_it
 * @property string|null $title_pl
 * @property string|null $title_ja
 * @property string|null $title_lt
 * @property string|null $title_lv
 * @property string|null $title_cz
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleBe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleCz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleEs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleIt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleJa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleLt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleLv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitlePl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitlePt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCities whereTitleUa($value)
 * @mixin \Eloquent
 */
class GeoCities extends Model
{
    protected $table = 'geo_cities';
}
