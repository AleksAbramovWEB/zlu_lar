<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geo\GeoRegions
 *
 * @property int $id
 * @property int $country_id
 * @property string|null $title псевдоним
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleBe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleCz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleEs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleIt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleJa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleLt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleLv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitlePl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitlePt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoRegions whereTitleUa($value)
 * @mixin \Eloquent
 */
class GeoRegions extends Model
{
    protected $table = 'geo_regions';
}
