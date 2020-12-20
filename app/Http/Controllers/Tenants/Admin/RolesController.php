<?php

namespace App\Http\Controllers\Tenants\Admin;

use App\Http\Controllers\Controller;

use App\Http\Request\Admins\UpdateRoleRequest;
use App\Models\Tenants\Admin\Permission;
use App\Models\Tenants\Admin\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RolesController extends Controller
{
    public function __construct()
    {
        //        $this->middleware(['auth','role:super-admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Tenants/Admin/Roles/Index', [
            'roles' => fn() =>Role::with('permissions')->get(),
            'colers' => fn() => ['primary', 'info', 'success', 'danger', 'warning']
        ])->withViewData(['title' => __('general.all_roles')]);

    }

    /**
     * We Don't use this function for create roles
     * we will seed the roles with migration.
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return Inertia::render('Tenants/Admin/Roles/Create', [
            'permissions' => fn() => $permissions,
        ])->withViewData(['title' => __('general.add_role')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255|unique:roles',
        ]);
        $role = Role::create($request->only('name'));
        if($request['permissions']) {
            foreach($request['permissions'] as $permission) {
                $role->givePermissionTo($permission);
            }
        }

        return redirect('/roles')->with('message', __('messages.role_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();
        $rolePermissions = $role->permissions()->pluck('id');

        return Inertia::render('Tenants/Admin/Roles/Edit', [
            'permissions' => fn() => $permissions,
            'rolePermissions' =>fn() => $rolePermissions,
            'role' => fn() => $role->only('id', 'name'),

        ])->withViewData(['title' => __('general.edit_role')]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $request->update();
        return Redirect::route('roles.index');
    }


}
