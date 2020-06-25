<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Video\VideoLikes
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $photo_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoLikes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoLikes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoLikes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoLikes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoLikes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoLikes wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoLikes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoLikes whereUserId($value)
 * @mixin \Eloquent
 * @property int $video_id
 * @property-read \App\Models\Video\Video|null $to_video
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoLikes whereVideoId($value)
 */
class VideoLikes extends Model
{
    protected $table = 'video_likes';


    protected $fillable = [
        'user_id',
        'video_id'
    ];

    public $timestamps = false;

    /**
     ********************** СВЯЗИ ***************************************************************************
     */


    public function to_video()
    {
        return$this->hasOne(Video::class,'id' ,'video_id');
    }
}
