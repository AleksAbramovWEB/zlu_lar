<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Video\VideoCategoryUnite
 *
 * @property int $video_id
 * @property int $category_id
 * @property-read \App\Models\Video\CategoriesVideo|null $to_category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoCategoryUnite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoCategoryUnite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoCategoryUnite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoCategoryUnite whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoCategoryUnite whereVideoId($value)
 * @mixin \Eloquent
 */
class VideoCategoryUnite extends Model
{
    protected $table = 'video_category_unite';

    /**
     ********************** СВЯЗИ ***************************************************************************
     */


    public function to_category()
    {
        return$this->hasOne(CategoriesVideo::class,'id' ,'category_id');
    }
}
