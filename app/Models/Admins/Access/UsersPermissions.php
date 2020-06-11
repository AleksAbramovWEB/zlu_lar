<?php

namespace App\Models\Admins\Access;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admins\Access\UsersPermissions
 *
 * @property int $user_id
 * @property int $permission_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersPermissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersPermissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersPermissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersPermissions wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersPermissions whereUserId($value)
 * @mixin \Eloquent
 * @property int $permissions_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersPermissions wherePermissionsId($value)
 */
class UsersPermissions extends Model
{
    protected $table = 'admins_users_permissions';
}
