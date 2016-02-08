<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
   
    // Route::auth(); // ne go koristime vgradenoto 5.2

	Route::group(['middleware' => 'cors' ,'prefix' => 'api'], function()
	{
	    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]); // only index method
	    Route::post('authenticate', 'AuthenticateController@authenticate'); // authenticate handles generating and returning a JWT.
	    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
	    Route::resource('register', 'RegisterController', ['only' => ['store']]); // only store method
	    Route::resource('posts', 'PostController');
	});  

   
	// Route::group(['middleware' => ['auth']], function(){


		// Route::group(array('prefix' => 'api'), function() {  

			// Route::get('users/{id}', 'UserController@show');

			// Route::get('api/posts', 'PostController@index');

			

			

			Route::get('users/{id}','UserController@user_posts')->where('id', '[0-9]+');

		  	Route::post('users/subscribe/{id}', 'UserController@subscribe')->where('id', '[0-9]+');

			// Route::get('posts/add', 'PostController@create');

			// Route::post('posts/add', 'PostController@store');

			// Route::get('posts/{id}',['as' => 'post', 'uses' => 'PostController@show'])->where('id', '[0-9]+');

			Route::get('posts/like/{id}', 'LikeController@store');

			Route::get('posts/unlike/{id}', 'LikeController@destroy');

			Route::post('comments/add', 'CommentController@store');

			Route::post('comments/delete/{id}', 'CommentController@destroy');	

		 // });
		
		  	
		  
	// });

});

