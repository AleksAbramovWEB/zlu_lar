<?php

namespace App\Models\Connexion\Gifts;

use App\Traits\LocalTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Connexion\Gifts\Gifts
 *
 * @property int $id
 * @property string $path
 * @property int $price
 * @property string $title_en
 * @property string $title_ru
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $created_at_local
 * @property-read mixed $last_time_local
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\Gifts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\Gifts newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Gifts\Gifts onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\Gifts query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\Gifts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\Gifts whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\Gifts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\Gifts wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\Gifts wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\Gifts whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\Gifts whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\Gifts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Gifts\Gifts withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Gifts\Gifts withoutTrashed()
 * @mixin \Eloquent
 * @property-read mixed $deleted_at_local
 * @property-read mixed $updated_at_local
 */
class Gifts extends Model
{
    use SoftDeletes;
    use LocalTimestamps;

    protected $table = 'gifts';

    protected $fillable = ['path','price', 'title_en', 'title_ru'];
}
