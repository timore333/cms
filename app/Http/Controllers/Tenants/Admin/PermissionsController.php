<?php

namespace App\Http\Controllers\Tenants\Admin;


use App\Models\Tenants\Admin\Permission;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PermissionsController extends Controller
{


    public function __construct(){

        $this->middleware(['auth','role:super-admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       $permissions = Permission::paginate(8);

       return view('admin.permissions.index',compact('permissions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return view('admin.permissions.create');
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
            'name' => 'required|min:3|max:255',
        ]);

        Permission::create($request->only('name'));
        return redirect('/permissions')->with('message','permission created!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Permission $permission
     * @return void
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
        ]);
        $permission->name=($request['name']);
        $permission->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return void
     * @throws Exception
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        //return back()->with('message','Permission deleted');
    }
}
