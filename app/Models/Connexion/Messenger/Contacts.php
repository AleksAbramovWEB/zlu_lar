<?php

namespace App\Models\Connexion\Messenger;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Connexion\Messenger\Contacts
 *
 * @property int $id
 * @property int $user_id
 * @property int $user_contact
 * @property int $user_creator
 * @property string $category
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Contacts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Contacts newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Messenger\Contacts onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Contacts query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Contacts whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Contacts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Contacts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Contacts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Contacts whereUserContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Contacts whereUserCreator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Contacts whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Messenger\Contacts withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Messenger\Contacts withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\User $to_user_contact
 * @property-read \App\Models\User $to_user_creator
 * @property-read \App\Models\User $to_user_id
 */
class Contacts extends Model
{

    public $timestamps = true;

    protected $table = 'messenger_contacts';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     ********************** СВЯЗИ ***************************************************************************
     */

    /**
     *  связь с таблицей users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to_user_id()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     *  связь с таблицей users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to_user_contact()
    {
        return $this->belongsTo(User::class, 'user_contact');
    }

    /**
     *  связь с таблицей users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to_user_creator()
    {
        return $this->belongsTo(User::class, 'user_creator');
    }

}
