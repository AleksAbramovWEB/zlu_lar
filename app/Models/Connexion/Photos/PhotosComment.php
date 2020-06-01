<?php

namespace App\Models\Connexion\Photos;

use App\Models\User;
use App\Traits\LocalTimestamps;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Connexion\Photos\PhotosComment
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $photo_id
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosComment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosComment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosComment wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\PhotosComment whereUserId($value)
 * @mixin \Eloquent
 * @property-read mixed $created_at_local
 * @property-read mixed $last_time_local
 * @property-read \App\Models\User|null $to_user_id
 * @property-read \App\Models\Connexion\Photos\Photos $to_photo_id
 */
class PhotosComment extends Model
{
    use LocalTimestamps;

    protected $table = 'photos_comment';

    protected $fillable = ['user_id', 'photo_id', 'comment'];

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







    public function left_time(){
        return $this->returnTimeFormat(
            $this->created_at_local,
            1, __('connexion/messenger.just'),
            10, __('connexion/messenger.minutes_ago')

        );
    }

}
