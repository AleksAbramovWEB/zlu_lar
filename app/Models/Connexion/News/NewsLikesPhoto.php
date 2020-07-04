<?php

namespace App\Models\Connexion\News;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Connexion\News\NewsLikesPhoto
 *
 * @property int $id
 * @property int $user_id
 * @property int $like_id
 * @property int $views
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsLikesPhoto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsLikesPhoto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsLikesPhoto query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsLikesPhoto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsLikesPhoto whereLikeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsLikesPhoto whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsLikesPhoto whereViews($value)
 * @mixin \Eloquent
 */
class NewsLikesPhoto extends Model
{
    protected $table = 'news_likes_photo';

    public $timestamps = false;

    protected $fillable = ['user_id', 'like_id', 'views'];
}
