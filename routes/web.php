<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Cms Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', function(){
	return redirect('/admin/login');
});

Route::group(['prefix' => 'admin'], function(){
	Auth::routes();
	
	Route::group(['middleware' => 'auth'], function(){
		Route::get('/', function() {
			return redirect('/admin/login');
		});
		Route::get('/dashboard', function() { 
			return view('cms.pages.dashboard');
		});
	});
});
