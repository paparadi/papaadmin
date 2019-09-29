<?php
	
	Route::group(['namespace' => 'Paparadi\Papaadmin\Http\Controllers', 'middleware' => ['web']], function(){
		Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
			
		});

	});
?>