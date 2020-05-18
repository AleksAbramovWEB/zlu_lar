<?php

namespace App\Models\Geo;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Geo\GeoCountries
 *
 * @property int $id
 * @property string $title_ru
 * @property string $title_en
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\GeoCountries whereTitleRu($value)
 * @mixin \Eloquent
 */
class GeoCountries extends Model
{
    protected $table = 'geo_countries';

//
//    public function user()
//    {
//        return $this->hasMany(User::class, 'id');
//    }

}
