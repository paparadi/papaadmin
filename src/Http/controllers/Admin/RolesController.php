<?php

namespace Paparadi\Papaadmin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles  = Role::where(['guard_name' => 'admin'])->get();
        return view('Papaadmin::admin.roles.index',[
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions    = Permission::where('guard_name', 'admin')->get();
        return view('Papaadmin::admin.roles.create',[
            'permissions'       => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                      => "required|unique:roles",
            'permissions.*'             => "exists:permissions,name",
        ]);
        $role = Role::create([
            'guard_name'    => 'admin',
            'name'          => $request->name,
        ]);
        $role->givePermissionTo(implode(',',$request->permissions));
        return redirect(route('admin.roles.index', [
            'success' => "Role Created Successfully"
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions    = Permission::where('guard_name', 'admin')->get();
        return view('Papaadmin::admin.roles.edit', [
            'role'          => $role,
            'permissions'   => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if($request->name != $role->name){
            $request->validate([
                'name'                 => "required|unique:roles",
            ]);
            $role->name                = $request->name;
            $role->save();
        }
        $request->validate([
            'permissions.*'            => "exists:permissions,name",
        ]);
        
        $role->syncPermissions($request->permissions);
        return redirect(route('admin.roles.index', [
            'success' => "Role Updated Successfully"
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
