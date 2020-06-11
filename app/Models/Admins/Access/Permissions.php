<?php

namespace App\Models\Admins\Access;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admins\Access\Permissions
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admins\Access\Roles[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Permissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Permissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Permissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Permissions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Permissions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Permissions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Permissions whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Permissions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permissions extends Model
{
    protected $table = 'admins_permissions';

    protected $fillable = ['name', 'slug'];

    public function roles()
    {
        return $this->belongsToMany(Roles::class,'admins_roles_permissions');
    }
}
