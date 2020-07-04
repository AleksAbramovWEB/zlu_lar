<?php

namespace App\Models\Connexion\News;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Connexion\News\NewsCommentPhoto
 *
 * @property int $id
 * @property int $user_id
 * @property int $comment_id
 * @property int $views
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsCommentPhoto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsCommentPhoto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsCommentPhoto query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsCommentPhoto whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsCommentPhoto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsCommentPhoto whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\News\NewsCommentPhoto whereViews($value)
 * @mixin \Eloquent
 */
class NewsCommentPhoto extends Model
{
    protected $table = 'news_comment_photo';

    public $timestamps = false;

    protected $fillable = ['user_id', 'comment_id', 'views'];
}
