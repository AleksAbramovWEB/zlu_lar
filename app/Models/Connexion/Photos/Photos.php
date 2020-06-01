<?php

namespace App\Models\Connexion\Photos;

use App\Traits\LocalTimestamps;
use App\Traits\S3FileWork;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Connexion\Photos\Photos
 *
 * @property int $id
 * @property int $user_id
 * @property string $path
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $path_s3
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\Photos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\Photos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\Photos query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\Photos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\Photos whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\Photos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\Photos wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\Photos whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Photos\Photos whereUserId($value)
 * @mixin \Eloquent
 * @property-read mixed $created_at_local
 * @property-read mixed $last_time_local
 */
class Photos extends Model
{
    use S3FileWork;
    use LocalTimestamps;

    protected $table = 'photos';
    protected $fillable = ['user_id', 'path', 'description'];

    public function returnLocalDate(){
        return $this->returnTimeFormat(
            $this->created_at_local,
            1, __('connexion/messenger.just'),
            10, __('connexion/messenger.minutes_ago')

        );
    }
}
