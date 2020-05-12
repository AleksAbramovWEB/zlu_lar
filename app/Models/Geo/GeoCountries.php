<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geo\GeoCountries
 *
 * @property int $id псевдоним
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleBe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleCz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleEs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleIt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleJa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleLt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleLv($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitlePl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitlePt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleUa($value)
 * @mixin \Eloquent
 */
class GeoCountries extends Model
{
    protected $table = 'geo_countries';
}
