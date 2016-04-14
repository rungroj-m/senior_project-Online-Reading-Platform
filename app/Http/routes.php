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
Route::get('feed', 'FeedController@index');

Route::group(['middleware' => 'auth'], function () {

	// Index
	Route::get('index', 'WelcomeController@index');

	//Request to create comic
	Route::post('comics/requestcomic',['as' =>'requestcomic','uses' => 'ProfileController@requestCreateComic']);

		// Books & Content Route
	Route::resource('comics/{book}/content', 'ContentController',['except' => ['show']]);
	Route::group(['middleware' => 'App\Http\Middleware\ContentMiddleware'], function() {
		Route::get('comics/{book}/content/{chapter}', 'ContentController@show');
	});
	Route::get('comics/search/', 'BookController@search');
	Route::post('comics/{book}/report', ['as' => 'report', 'uses' => 'BookController@report']);
	Route::post('comics/{book}/ratings', ['as' => 'comics.rating', 'uses' => 'BookController@rate']);
	Route::resource('comics', 'BookController');

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
	Route::delete('comics/{book}/content/review/{review}/', [ 'as' => 'deletereview', 'uses' =>'reviewController@deleteReview']);
	Route::group(['middleware' => 'App\Http\Middleware\CriticMiddleware'], function () {
		Route::post('comics/{book}/content/review', 'ReviewController@postReview');
	});

	// Books & Content Route
	Route::resource('books/{book}/content', 'ContentController',['except' => ['show']]);
	Route::group(['middleware' => 'App\Http\Middleware\ContentMiddleware'], function() {
		 Route::get('books/{book}/content/{chapter}', 'ContentController@show');
	 });
	Route::get('books/search/', 'BookController@search');
	Route::resource('books','BookController');
	Route::post('books/{book}/report', [ 'as' => 'report', 'uses' => 'BookController@report']);
	Route::post('books/{book}/ratings', ['as' => 'books.rating', 'uses' => 'BookController@rate']);

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
	Route::post('profile/image/',['as' => 'profile/image/','uses' => 'ProfileController@imageSave']);
	Route::get('profile/edit','ProfileController@getEdit');
	Route::put('profile',['as' => 'profile','uses' =>'ProfileController@update']);
	Route::get('profile/subscription', 'SubscriptionController@index');
	Route::get('profile/notification', 'ProfileController@notification');
	// Route::get('profile/preference', 'ProfileController@preference');
	// Route::put('profile/preference', 'ProfileController@update_preference');

	// Review Routes
	Route::get('books/{book}/content/review/{review}/up', 'ReviewController@voteUpReview');
	Route::get('books/{book}/content/review/{review}/down', 'ReviewController@voteDownReview');
	Route::delete('books/{book}/content/review/{review}/', [ 'as' => 'deletereview', 'uses' =>'reviewController@deleteReview']);
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
		Route::get('admin/user', 'AdminController@user');
		Route::get('admin', 'AdminController@index');
		Route::get('admin/user/{user}/accept', 'AdminController@accept');
	});

	Route::get('donation', 'DonationController@index');
	Route::get('donation/create', 'DonationController@create_donation');
	Route::get('donation/plead/create', 'DonationController@create_pleading');
	Route::post('donation/create', 'DonationController@store_donation');
	Route::post('donation/plead/create', 'DonationController@store_pleading');
	Route::get('donation/{id}', 'DonationController@show');
	Route::get('donation/{id}/edit', 'DonationController@edit');
	Route::put('donation/{id}/edit', ['as' => 'donation-edit', 'uses' => 'DonationController@update']);
	Route::get('plead/{id}/edit', 'DonationController@edit_plead');
	Route::put('plead/{id}/edit', ['as' => 'plead-edit', 'uses' => 'DonationController@update_plead']);
	Route::delete('donation/{id}', 'DonationController@destroy');
	Route::delete('plead/{id}', 'DonationController@destroy_plead');
	Route::put('plead/{id}/confirm', ['as' => 'plead-confirm', 'uses' => 'DonationController@confirm_plead']);
	Route::put('plead/{id}/unconfirm', ['as' => 'plead-unconfirm', 'uses' => 'DonationController@unconfirm_plead']);
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
