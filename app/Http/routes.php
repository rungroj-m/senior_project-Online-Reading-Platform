<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('home', 'WelcomeController@index');

Route::controllers([
	'password' => 'Auth\PasswordController',
]);

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

Route::resource('books','BookController');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('books/{book}/content', 'ContentController');
//	Route::get('profile','ProfileController@index');

	Route::get('profile/image','ProfileController@imageUpload');
	Route::post('profile/image/save',[
		'as' => 'profile/image/save','uses' => 'ProfileController@imageSave'
	]);

	Route::Controller('profile','ProfileController');
	Route::get('profile/edit','ProfileController@edit');
	Route::put('profile',[
		'as' => 'profile','uses' =>'ProfileController@update'
	]);

	Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {
		Route::get('admin/user/create', 'AdminController@create');
		Route::post('admin/user/create', 'AdminController@store');
		Route::get('admin/user/{id}/edit', 'AdminController@edit');
		Route::put('admin/user/{id}/edit', [
			'as' => 'admin-edit-user', 'uses' => 'AdminController@update'
		]);
		Route::delete('admin/user/{id}', 'AdminController@destroy');
		Route::get('admin', 'AdminController@index');
	});
});


Route::any('/', 'WelcomeController@index');
