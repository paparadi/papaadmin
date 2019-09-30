<?php
	
	Route::group(['namespace' => 'Paparadi\Papaadmin\Http\Controllers', 'middleware' => ['web']], function(){
		Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
			Route::namespace('Auth')->group(function(){

				Route::get('/login','LoginController@show')->name('login');
				Route::post('/login','LoginController@login');
				Route::post('/logout','LoginController@logout')->name('logout');

			});
			Route::get('/permissions', 'PermissionsController@index')->name('permissions.index');
			Route::get('/permissions/create', 'PermissionsController@create')->name('permissions.create');
			Route::post('/permissions', 'PermissionsController@store')->name('permissions.store');
			Route::get('permissions/{permission}/edit', 'PermissionsController@edit')->name('permissions.edit');
			Route::put('/permissions/{permission}', 'PermissionsController@update')->name('permissions.update');
			Route::delete('/permissions/{permission}', 'PermissionsController@destroy')->name('permissions.destroy');

			Route::get('/roles', 'RolesController@index')->name('roles.index');
			Route::get('/roles/create', 'RolesController@create')->name('roles.create');
			Route::post('/roles', 'RolesController@store')->name('roles.store');
			Route::get('roles/{role}/edit', 'RolesController@edit')->name('roles.edit');
			Route::put('/roles/{role}', 'RolesController@update')->name('roles.update');
			Route::delete('/roles/{role}', 'RolesController@destroy')->name('roles.destroy');
		});
	});
?>