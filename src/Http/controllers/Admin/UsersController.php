<?php

namespace Paparadi\Papaadmin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Paparadi\Papaadmin\Models\Agent;
use Spatie\Permission\Models\Role;
use App\Http\Requests\AdminUser;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class UsersController extends Controller
{
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$users = Agent::all();
		return view('Papaadmin::admin.users.index', [
			'users'  => $users,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$roles = Role::where(['guard_name' => 'admin'])->get();
		return view('Papaadmin::admin.users.create',[
			'roles' => $roles,
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
		
		$data                   = $request->validate([
			"name"                  => "required",
			"email"                 => "required|email|unique:agents",
			"password"              => "required|min:8|same:confirm_password",
			"confirm_password"      => "required",
			"role"                  => "required",
			"image"                 => "image",
			"status"                => "required",
		]);
		$data['password']       = Hash::make($request->password);
		$data['status']         = 1;
		if(!empty($data['image'])){
			$imgPath                = request('image')->store('uploads', 'public');
			$image                  = Image::make(public_path("storage/". $imgPath))->fit(1200,1200);
			$image->save();
			$data['image']          = $imgPath;
		}
		$user                   = Agent::create($data);
		$user->assignRole($data['role']);
		return redirect(route('admin.users.index'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Agent $user)
	{
		$roles = Role::where(['guard_name' => 'admin'])->get();
		return view('Papaadmin::admin.users.edit',[
			'user'  => $user,
			'roles' => $roles,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Agent $user)
	{
		$request->validate([
			"name"                  => "required",
			"role"                  => "required",
			"status"                => "required",
		]);

		$user->name                 = $request->name;
		$user->status				= $request->status;
		$user->syncRoles($request->role);

		if(!empty($request->email) AND $request->email != $user->email){
			$request->validate([
				"email"                 => "required|email|unique:agents",
			]);
			$user->email                = $request->email;
		}

		if(!empty($request->password)){
			$request->validate([
				"password"              => "required|min:8|same:confirm_password",
				"confirm_password"      => "required",
			]);
			$user->password 		= Hash::make($request->password);
		}

		if(!empty($request->image)){
			$request->validate([
				"image"                 => "image",
			]);
			$imgPath                = request('image')->store('uploads', 'public');
			$image                  = Image::make(public_path("storage/". $imgPath))->fit(1200,1200);
			$image->save();
			$user->image          = $imgPath;
		}

		$user->save();
		return redirect(route('admin.users.index',[
			'success' => "User Updated Successfully"
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
