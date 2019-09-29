<?php

namespace Paparadi\Papaadmin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Construct the controller and only allow authorized users
     *
     */
    public function __construct(){
        $user;
        $this->middleware(function($request, $next){
            $user = auth('admin')->user();
            if(!$user->can('manage_permissions')){
                abort('403');
            }
            return $next($request); 
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions    = Permission::where(['guard_name' => 'admin'])->get();
        return view("Papaadmin::admin.permissions.index",[
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Papaadmin::admin.permissions.create');
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
            'name' => "required|unique:permissions",
        ]);
        $permission = Permission::create([
            'guard_name'    => 'admin',
            'name'          => $request->name,
        ]);
        return redirect(route('admin.permissions.index', [
            'success' => "Permission Created Successfully"
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
    public function edit(Permission $permission)
    {
        return view('Papaadmin::admin.permissions.edit', [
            'permission'        => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name'      => 'required|unique:permissions',
        ]);
        $permission->name = $request->name;
        $permission->save();
        return redirect(route('admin.permissions.index', ['success' => 'Permission Updated Successfully!']));
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
