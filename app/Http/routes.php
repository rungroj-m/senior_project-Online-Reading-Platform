<?php

Route::controllers([
	'password' => 'Auth\PasswordController',
]);

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

//Social Login
Route::get('/login/{provider?}',[
	'uses' => 'Auth\AuthController@getSocialAuth',
	'as'   => 'auth.getSocialAuth'
]);
Route::get('/login/callback/{provider?}',[
	'uses' => 'Auth\AuthController@getSocialAuthCallback',
	'as'   => 'auth.getSocialAuthCallback'
]);


// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

Route::group(['middleware' => 'auth'], function () {

	// Index
	Route::get('index', 'WelcomeController@index');

	// Books & Content Route
	Route::get('books/search/', 'BookController@searchName');
	Route::resource('books','BookController');
	Route::resource('books/{book}/content', 'ContentController');

	// Comment Routes
	Route::post('books/{book}/content/comment', 'CommentController@postComment');
	Route::put('books/{book}/content/comment/{comment}/up', 'CommentController@voteUpComment');
	Route::put('books/{book}/content/comment/{comment}/down', 'CommentController@voteDownComment');

	// Subscription Route
	Route::get('books/{book}/subscribe', [ 'as' => 'subscribe', 'uses' => 'SubscriptionController@subscribe']);
	Route::get('books/{book}/unsubscribe', [ 'as' => 'unsubscribe', 'uses' => 'SubscriptionController@unsubscribe']);

	// Profile Routes
	Route::get('profile/{id}','ProfileController@index');
	Route::get('profile/image','ProfileController@imageUpload');
	Route::post('profile/image/save',['as' => 'profile/image/save','uses' => 'ProfileController@imageSave']);
	Route::Controller('profile','ProfileController');
	Route::get('profile/edit','ProfileController@edit');
	Route::put('profile',['as' => 'profile','uses' =>'ProfileController@update']);
	Route::get('profile/subscription', 'SubscriptionController@index');

	// Admin Routes
	Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {
		Route::get('admin/user/create', 'AdminController@create');
		Route::post('admin/user/create', 'AdminController@store');
		Route::get('admin/user/{id}/edit', 'AdminController@edit');
		Route::put('admin/user/{id}/edit', ['as' => 'admin-edit-user', 'uses' => 'AdminController@update']);
		Route::delete('admin/user/{id}', 'AdminController@destroy');
		Route::get('admin', 'AdminController@index');
		Route::get('admin/bookreport', 'AdminController@bookReport');
	});
});

Route::get('/', 'WelcomeController@welcome');
