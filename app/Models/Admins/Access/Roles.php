<?php

namespace App\Models\Admins\Access;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admins\Access\Roles
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admins\Access\Permissions[] $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Roles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Roles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Roles query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Roles whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Roles whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Roles whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Roles whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\Roles whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Roles extends Model
{
    protected $table = 'admins_roles';

    protected $fillable = ['name', 'slug'];

    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'admins_roles_permissions');
    }
}
