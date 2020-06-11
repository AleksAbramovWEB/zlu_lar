<?php

namespace App\Models\Admins\Access;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admins\Access\RolesPermissions
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\RolesPermissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\RolesPermissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\RolesPermissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\RolesPermissions wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\RolesPermissions whereRoleId($value)
 * @mixin \Eloquent
 * @property int $roles_id
 * @property int $permissions_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\RolesPermissions wherePermissionsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\RolesPermissions whereRolesId($value)
 */
class RolesPermissions extends Model
{
    protected $table = 'admins_roles_permissions';

    protected $fillable = ['roles_id', 'permissions_id'];
}
