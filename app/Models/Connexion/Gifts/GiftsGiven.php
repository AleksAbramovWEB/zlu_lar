<?php

namespace App\Models\Connexion\Gifts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Connexion\Gifts\GiftsGiven
 *
 * @property int $id
 * @property int $gift_id
 * @property int $whom_user_id
 * @property int|null $from_user_id
 * @property int $not_visible
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $to_from_user_id
 * @property-read \App\Models\Connexion\Gifts\Gifts $to_gift_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\GiftsGiven newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\GiftsGiven newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\GiftsGiven query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\GiftsGiven whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\GiftsGiven whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\GiftsGiven whereFromUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\GiftsGiven whereGiftId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\GiftsGiven whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\GiftsGiven whereNotVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\GiftsGiven whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Gifts\GiftsGiven whereWhomUserId($value)
 * @mixin \Eloquent
 */
class GiftsGiven extends Model
{
    protected $table = "gifts_given";

    protected $fillable = ['gift_id', 'whom_user_id', 'from_user_id', 'not_visible', 'comment'];


    /**
     ********************** СВЯЗИ ***************************************************************************
     */

    /**
     *  связь с таблицей users
     *  from_user_id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to_from_user_id()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }
    /**
     *  связь с таблицей gifts
     *  from_user_id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to_gift_id()
    {
        return $this->belongsTo(Gifts::class, 'gift_id', 'id');
    }
}
