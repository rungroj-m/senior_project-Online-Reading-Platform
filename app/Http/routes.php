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

	Route::group(['middleware' => 'App\Http\Middleware\ImageMiddleware'], function() {
		// Books & Content Route
		Route::get('comics/search/', 'BookController@search');
		Route::resource('comics', 'BookController');
		Route::resource('comics/{book}/content', 'ContentController');
		Route::get('comics/{book}/report', ['as' => 'report', 'uses' => 'ContentController@report']);

		// Comment Routes
		Route::post('comics/{book}/content/comment', 'CommentController@postComment');
		Route::get('comics/{book}/content/comment/{comment}/up', 'CommentController@voteUpComment');
		Route::get('comics/{book}/content/comment/{comment}/down', 'CommentController@voteDownComment');
		Route::get('comics/{book}/content/comment/{comment}/report', ['as' => 'commentreport', 'uses' => 'CommentController@report']);
		Route::post('comics/{book}/content/comment/{comment}/', 'CommentController@repliedComment');
		Route::delete('comics/{book}/content/comment/{comment}/', ['as' => 'deletecomment', 'uses' => 'CommentController@deleteComment']);

		// Subscription Route
		Route::get('comics/{book}/subscribe', ['as' => 'subscribe', 'uses' => 'SubscriptionController@subscribe']);
		Route::get('comics/{book}/unsubscribe', ['as' => 'unsubscribe', 'uses' => 'SubscriptionController@unsubscribe']);

		// Review Routes
		Route::get('comics/{book}/content/review/{review}/up', 'ReviewController@voteUpReview');
		Route::get('comics/{book}/content/review/{review}/down', 'ReviewController@voteDownReview');
		Route::group(['middleware' => 'App\Http\Middleware\CriticMiddleware'], function () {
			Route::post('comics/{book}/content/review', 'ReviewController@postReview');
		});
	});

	// Books & Content Route
	Route::get('books/search/', 'BookController@search');
	Route::resource('books','BookController');
	Route::resource('books/{book}/content', 'ContentController');
	Route::get('books/{book}/report', [ 'as' => 'report', 'uses' => 'ContentController@report']);

	// Comment Routes
	Route::post('books/{book}/content/comment', 'CommentController@postComment');
	Route::get('books/{book}/content/comment/{comment}/up', 'CommentController@voteUpComment');
	Route::get('books/{book}/content/comment/{comment}/down', 'CommentController@voteDownComment');
	Route::get('books/{book}/content/comment/{comment}/report', [ 'as' => 'commentreport', 'uses' => 'CommentController@report']);
	Route::post('books/{book}/content/comment/{comment}/', 'CommentController@repliedComment');
	Route::delete('books/{book}/content/comment/{comment}/', [ 'as' => 'deletecomment', 'uses' =>'CommentController@deleteComment']);

	// Subscription Route
	Route::get('books/{book}/subscribe', [ 'as' => 'subscribe', 'uses' => 'SubscriptionController@subscribe']);
	Route::get('books/{book}/unsubscribe', [ 'as' => 'unsubscribe', 'uses' => 'SubscriptionController@unsubscribe']);

	// Profile Routes
	Route::get('user/{id}', 'ProfileController@showProfile');
	Route::get('profile','ProfileController@index');
	Route::get('profile/image','ProfileController@imageUpload');
	Route::post('profile/image/save',['as' => 'profile/image/save','uses' => 'ProfileController@imageSave']);
	Route::get('profile/edit','ProfileController@edit');
	Route::put('profile',['as' => 'profile','uses' =>'ProfileController@update']);
	Route::get('profile/subscription', 'SubscriptionController@index');
	Route::get('profile/notification', 'ProfileController@notification');

	// Review Routes
	Route::get('books/{book}/content/review/{review}/up', 'ReviewController@voteUpReview');
	Route::get('books/{book}/content/review/{review}/down', 'ReviewController@voteDownReview');
	Route::group(['middleware' => 'App\Http\Middleware\CriticMiddleware'], function() {
		Route::post('books/{book}/content/review', 'ReviewController@postReview');
	});

	// Admin Routes
	Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {
		Route::get('admin/user/create', 'AdminController@create');
		Route::post('admin/user/create', 'AdminController@store');
		Route::get('admin/user/{id}/edit', 'AdminController@edit');
		Route::put('admin/user/{id}/edit', ['as' => 'admin-edit-user', 'uses' => 'AdminController@update']);
		Route::delete('admin/user/{id}', 'AdminController@destroy');
		Route::get('admin', 'AdminController@index');
		Route::get('admin/bookreport', 'AdminController@bookReport');
		Route::get('admin/commentreport', 'AdminController@commentReport');
	});

	Route::get('donation', 'DonationController@index');
	Route::get('donation/create', 'DonationController@create_donation');
	Route::get('donation/plead/create', 'DonationController@create_pleading');
	Route::post('donation/create', 'DonationController@store_donation');
	Route::post('donation/plead/create', 'DonationController@store_pleading');
	Route::get('donation/{id}', 'DonationController@show');
	Route::get('donation/{id}/edit', 'DonationController@edit');
	Route::put('donation/{id}/edit', 'DonationController@update');
});

Route::get('images/{filename}', function($filename){

	$path = storage_path().'/'.$filename;
	$file = File::get($path);
	$type = File::mimeType($path);

	$response = Response::make($file, 200);
	$response->header("Content-Type", $type);

	return $response;
});

Route::get('/', 'WelcomeController@welcome');
