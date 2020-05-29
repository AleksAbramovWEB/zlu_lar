<?php

namespace App\Models\Connexion\Messenger;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Connexion\Messenger\PhotoSend
 *
 * @property int $id
 * @property int $message_id
 * @property int $photo_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\PhotoSend newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\PhotoSend newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\PhotoSend query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\PhotoSend whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\PhotoSend whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\PhotoSend whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\PhotoSend wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\PhotoSend whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Connexion\Messenger\Photos|null $photo
 */
class PhotoSend extends Model
{
    protected $table = 'messenger_photo_send';

    protected $fillable = [
        'message_id', 'photo_id'
    ];

    /**
     ********************** СВЯЗИ ***************************************************************************
     */

    public function photo()
    {
        return $this->hasOne(Photos::class,'id' ,'photo_id');
    }
}
