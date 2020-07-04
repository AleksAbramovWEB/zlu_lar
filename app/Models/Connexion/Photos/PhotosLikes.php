<?php

namespace App\Models\Connexion\Photos;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Connexion\Photos\PhotosLikes
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $photo_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosLikes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosLikes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosLikes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosLikes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosLikes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosLikes wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosLikes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosLikes whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User|null $to_user_id
 * @property-read \App\Models\Connexion\Photos\Photos $to_photo_id
 */
class PhotosLikes extends Model
{
    protected $table = 'photos_likes';

    protected $fillable = ['user_id', 'photo_id'];

    /**
     ********************** СВЯЗИ ***************************************************************************
     */

    /**
     *  связь с таблицей users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to_user_id()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     *  связь с таблицей photos
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to_photo_id()
    {
        return $this->belongsTo(Photos::class, 'photo_id', 'id');
    }
}
