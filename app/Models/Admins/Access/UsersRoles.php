<?php

namespace App\Models\Admins\Access;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admins\Access\UsersRoles
 *
 * @property int $user_id
 * @property int $role_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersRoles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersRoles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersRoles query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersRoles whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersRoles whereUserId($value)
 * @mixin \Eloquent
 * @property int $roles_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admins\Access\UsersRoles whereRolesId($value)
 */
class UsersRoles extends Model
{
    protected $table = 'admins_users_roles';
}
