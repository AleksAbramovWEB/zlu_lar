<?php

namespace App\Models\Video;

use App\Traits\LocalTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Video\CategoriesVideo
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $title_ru
 * @property string $title_en
 * @property int $published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\CategoriesVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\CategoriesVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\CategoriesVideo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\CategoriesVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\CategoriesVideo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\CategoriesVideo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\CategoriesVideo wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\CategoriesVideo whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\CategoriesVideo whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\CategoriesVideo whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\CategoriesVideo whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $created_at_local
 * @property-read mixed $deleted_at_local
 * @property-read mixed $last_time_local
 * @property-read mixed $updated_at_local
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Video\CategoriesVideo onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Video\CategoriesVideo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Video\CategoriesVideo withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Video\VideoCategoryUnite[] $to_videos
 * @property-read int|null $to_videos_count
 */
class CategoriesVideo extends Model
{
    use LocalTimestamps;
    use SoftDeletes;

    protected $table = 'video_categories';

    protected $fillable = ['slug', 'title_ru', 'title_en', 'published'];

    /**
     ********************** СВЯЗИ ***************************************************************************
     */


    public function to_videos()
    {
        return $this->hasMany(VideoCategoryUnite::class,'category_id' ,'id');
    }
}
