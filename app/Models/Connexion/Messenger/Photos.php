<?php

namespace App\Models\Connexion\Messenger;

use App\Traits\S3FileWork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Connexion\Messenger\Photos
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $path_s3
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Photos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Photos newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Messenger\Photos onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Photos query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Photos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Photos whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Photos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Photos wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Photos whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Connexion\Messenger\Photos whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Messenger\Photos withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Connexion\Messenger\Photos withoutTrashed()
 * @mixin \Eloquent
 */
class Photos extends Model
{

    use SoftDeletes;
    use S3FileWork;

    protected $table = 'messenger_photos';

    protected $fillable = ['user_id', 'path'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
