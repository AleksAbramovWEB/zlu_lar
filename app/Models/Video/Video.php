<?php

namespace App\Models\Video;

use App\Traits\LocalTimestamps;
use App\Traits\S3FileWork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Video\Video
 *
 * @property int $id
 * @property string $path_video
 * @property string $path_img
 * @property string $title_ru
 * @property string $title
 * @property string $title_en
 * @property string $description_ru
 * @property string $description_en
 * @property string $description
 * @property int $published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $created_at_local
 * @property-read mixed $deleted_at_local
 * @property-read mixed $last_time_local
 * @property-read string|null $path_s3
 * @property-read mixed $s3_path_img
 * @property-read mixed $s3_path_video
 * @property-read mixed $updated_at_local
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Video\Video onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video wherePathImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video wherePathVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Video\Video withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Video\Video withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Video\VideoCategoryUnite[] $to_categories
 * @property-read int|null $to_categories_count
 */
class Video extends Model
{

    use SoftDeletes;
    use S3FileWork;
    use LocalTimestamps;

    protected $table = 'video';

    protected $fillable = [
        'path_video',
        'path_img',
        'title_ru',
        'title_en',
        'description_ru',
        'description_en',
        'published'
    ];


    public function getS3PathVideoAttribute()
    {
        if ($this->path_video)
            return $this->getPathS3href($this->path_video);
        else return NULL;
    }

    public function getS3PathImgAttribute()
    {
        if ($this->path_img)
            return $this->getPathS3href($this->path_img);
        else return NULL;
    }

    /**
     ********************** СВЯЗИ ***************************************************************************
     */


    public function to_categories()
    {
        return $this->hasMany(VideoCategoryUnite::class,'video_id' ,'id');
    }

}
