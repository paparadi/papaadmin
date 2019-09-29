<?php
	
	Route::group(['namespace' => 'Paparadi\Papaadmin\Http\Controllers', 'middleware' => ['web']], function(){
		Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
			Route::namespace('Auth')->group(function(){
				
				Route::get('/login','LoginController@show')->name('login');
				Route::post('/login','LoginController@login');
				Route::post('/logout','LoginController@logout')->name('logout');	
			});
		});
	});
?>