<?php

namespace App\Http\Controllers\Tenants\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Tenants\Admin\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    use PasswordValidationRules;

    public function __construct()
    {
        //
        //        $this->middleware('role:super-admin')->except('show','edit','update','updatePassword');
        //        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Tenants/Admin/Users/Index', [
            'users' =>fn()=> User::with('phones')->get(),
        ])->withViewData(['title' => __('general.users')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::get();
        return Inertia::render('Tenants/Admin/Users/Create', [
            'roles' => $roles,
        ])->withViewData(['title' => __('general.create_user')]);
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param Request $request
     * @return User
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => 'required|string|max:255|unique:users',
            'role' => 'required',
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'password' => Hash::make($request['password']),
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'address' => $request['address'],
            'position' => $request['position'],
            'medical_id' => $request['medical_id'],
            'speciality' => $request['speciality'],
        ]);

        if($request->phones) {
            $user->addPhones($request->phones);
        }

        $user->assignRole($request['role']['id']);
        return redirect('/users');
    }


    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        $user->load('phones');
        return Inertia::render('Tenants/Admin/Users/Show', [
            'user' => fn() => $user,
            'suerPermissions' => fn() => $user->getPermissionNames(),
        ])->withViewData(['title' => __('general.edit_user')]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $user->load('phones');
        return Inertia::render('Tenants/Admin/Users/Edit', [
            'user' => fn() => $user,
            'roles' => fn() => Role::with('permissions')->get(),
            'permissions' => fn() => Permission::get(),
            'userPermissions' => fn() => $user->getPermissionNames()->keys()->all(),
        ])->withViewData(['title' => __('general.edit_user')]);


    }

    /**
     * Update the specified user personal data and role in storage.
     * @param UpdateUserRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $request->update();
        return back()->with('message-success', __('messages.user_updated.'));
    }

    /**
     * Update the specified user password.
     *
     * @param App\Requests\UpdatePasswordRequest $request
     * @param User $user
     * @return Response
     */

    public function updatePassword(UpdatePasswordRequest $request, User $user)
    {
        $request->updatePassword();
    }

    /**
     * Update the specified user permissions.
     *
     * @param Illuminate\Http\Request $request
     * @param User $user
     * @return Response
     */

    public function updatePermissions(Request $request, User $user)
    {
        $user->removeAllPermissions();
        if($request['permissions']) {
            foreach($request['permissions'] as $permission) {
                $user->givePermissionTo((int)$permission);
            }
        }
        return redirect('/users/' . $user->id . '/edit')->with('message-success', __('messages.permission_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     * @throws Exception
     */
    public function destroy(User $user)
    {
        // check if the user is super admin
        if($user->getRole() === 'super-admin') {
            // we need to check if there is any super admins or not before Deleting.
            if(User::admins()->count() === 1) {
                return redirect('/users')->with('message-error', __('messages.can_not_delete_admin'));;
            }
        }
        $user->delete();
        return redirect('/users')->with('message-success', __('messages.user_deleted.'));
    }

}
