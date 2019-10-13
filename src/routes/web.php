<?php
	
	Route::group(['namespace' => 'Paparadi\Papaadmin\Http\Controllers', 'middleware' => ['web']], function(){
		Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
			Route::namespace('Auth')->group(function(){

				Route::get('/login','LoginController@show')->name('login');
				Route::post('/login','LoginController@login');
				Route::post('/logout','LoginController@logout')->name('logout');

			});
			Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

			Route::middleware('permission:manage_permissions')->group(function(){
				Route::get('/permissions', 'PermissionsController@index')->name('permissions.index');
				Route::get('/permissions/create', 'PermissionsController@create')->name('permissions.create');
				Route::post('/permissions', 'PermissionsController@store')->name('permissions.store');
				Route::get('permissions/{permission}/edit', 'PermissionsController@edit')->name('permissions.edit');
				Route::put('/permissions/{permission}', 'PermissionsController@update')->name('permissions.update');
				Route::delete('/permissions/{permission}', 'PermissionsController@destroy')->name('permissions.destroy');
			});

			Route::middleware('permission:manage_users')->group(function(){
				Route::get('/roles', 'RolesController@index')->name('roles.index');
				Route::get('/roles/create', 'RolesController@create')->name('roles.create');
				Route::post('/roles', 'RolesController@store')->name('roles.store');
				Route::get('roles/{role}/edit', 'RolesController@edit')->name('roles.edit');
				Route::put('/roles/{role}', 'RolesController@update')->name('roles.update');
				Route::delete('/roles/{role}', 'RolesController@destroy')->name('roles.destroy');
			});
			
			Route::middleware('permission:manage_users')->group(function(){
				Route::get('/users', 'UsersController@index')->name('users.index');
				Route::get('/users/create', 'UsersController@create')->name('users.create');
				Route::post('/users', 'UsersController@store')->name('users.store');
				Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');
				Route::put('/users/{user}', 'UsersController@update')->name('users.update');
				Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');
			});
		});
	});
?>