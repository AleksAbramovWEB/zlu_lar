<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Master\AddRoleRequest;
use App\Http\Requests\Admin\Master\UpdateRoleRequest;
use App\Models\Admins\Access\Roles;
use App\Models\Admins\Access\RolesPermissions;
use App\Repositories\Admins\Access\PermissionsRepository;
use App\Repositories\Admins\Access\RolesPermissionsRepository;
use App\Repositories\Admins\Access\RolesRepository;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RolesRepository $rolesRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesRepository $rolesRepository)
    {
        $roles = $rolesRepository->getAllRoles();
        return view('admin.master.roles.roles_index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.roles.roles_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddRoleRequest $request
     * @param Roles          $roles
     *
     * @return void
     */
    public function store(AddRoleRequest $request, Roles $roles)
    {
        $roles->create($request->input());
        return redirect()->route("admin.master.roles.index");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param                                 $id
     * @param RolesRepository                 $rolesRepository
     * @param PermissionsRepository           $permissionsRepository
     *
     * @return void
     */
    public function edit
    (
        $id,
        RolesRepository $rolesRepository,
        PermissionsRepository $permissionsRepository
    )
    {
        $role = $rolesRepository->getRoleById($id);
        $permissions = $permissionsRepository->getAllPermissionsAndRoleActively($id);
        return view("admin.master.roles.roles_edit", compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest          $request
     * @param RolesRepository            $rolesRepository
     * @param                            $id
     * @param PermissionsRepository      $permissionsRepository
     *
     * @param RolesPermissionsRepository $rolesPermissionsRepository
     *
     * @return void
     */
    public function update
    (
        UpdateRoleRequest $request,
        RolesRepository $rolesRepository, $id,
        PermissionsRepository $permissionsRepository,
        RolesPermissionsRepository $rolesPermissionsRepository
    )
    {
        $inputs = $request->input();
        $role = $rolesRepository->getRoleById($id);
        $role->update($inputs);
        $this->updatePermissionsForeRole($inputs, $permissionsRepository, $rolesPermissionsRepository, $id);
        return back()->with('success', true);
    }


    private function updatePermissionsForeRole(
        array $inputs,
        PermissionsRepository $permissionsRepository,
        RolesPermissionsRepository $rolesPermissionsRepository,
        $role_id
    ){
        $not_key = ['_token', '_method', 'name', 'slug'];

        foreach ($inputs as $slug => $val){
            if (in_array($slug, $not_key)) continue;
            $permission_id = $permissionsRepository->getPermissionIdBySlug($slug);
            $permission_role_exists = $rolesPermissionsRepository->getExists($role_id, $permission_id);
            if (!$permission_role_exists AND $val == 1){
                (new RolesPermissions())::insert(['roles_id' => $role_id, 'permissions_id' => $permission_id]);
            }elseif ($permission_role_exists AND $val == 0){
                (new RolesPermissions())::where([
                    ['roles_id', $role_id],
                    ['permissions_id', $permission_id]
                ])->delete();
            }
        }
    }

}
