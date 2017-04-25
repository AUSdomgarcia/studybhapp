<?php

/*
|-------------
| Web Routes
|-------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|-------------
| Cms Routes
|-------------
*/
Route::get('/login', function(){
	return redirect('/admin/login');
});
Route::get('/dashboard', function(){
	return redirect('/admin/dashboard');
});

Route::group(['prefix' => 'admin'], function(){
	Auth::routes();
	Route::get('/', function(){
		return redirect('admin/login');
	});

	Route::group(['middleware' => ['auth','roles']], function(){

		Route::get('/dashboard', function() {
			if(Auth::user()->role_id == 3){
				return redirect('/admin/inquiry');
			}
			return view('cms.pages.dashboard');
		});
		/*
		  |-----------------------
          | When - Registered (NA)
          |-----------------------
        */
		Route::get('/user', function() {
			return 'User Registered Successfully.';
		});
		/*
		  |----------------
          | Role - Editors
          |----------------
        */
        Route::group( ['roles' => ['Editors'] ] , function(){
			Route::get('/pages/news', function() { 
				return view('cms.pages.default');
			});
			Route::get('/pages/about', function() { 
				return view('cms.pages.default');
			});
			Route::get('/pages/faq', function() { 
				return view('cms.pages.default');
			});
			Route::get('/homepage_default', function() {
				return view('cms.pages.default');
			});
		});
		/*
		  |--------------------
          | Role - Moderators
          |--------------------
        */
        Route::group( ['roles' => ['Moderators'] ] , function(){
			Route::get('/inquiry', function(){ 
				return view('cms.pages.inquiry');
			});
		});
		/*
		  |-----------------------
          | Role - Administrators
          |-----------------------
        */
		Route::group(['roles' => ['Administrators']], function(){
			Route::get('/user_settings', 'UserSettingsController@index');
			Route::get('/user_settings/show/{id}', 'UserSettingsController@show');
			Route::post('/user_settings/store', 'UserSettingsController@store');
			Route::post('/user_settings/update', 'UserSettingsController@update');
			Route::post('/user_settings/destroy', 'UserSettingsController@destroy');
			Route::post('/user_settings/unlock', 'UserSettingsController@unlock');
		});
		
		Route::get('/my_account', function() {
			return view('cms.pages.default');
		});

	//-End-Of-Auth-Page-
	});
});