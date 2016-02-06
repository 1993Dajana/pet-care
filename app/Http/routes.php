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
    return view('welcome');
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
   
    Route::auth();

    

    // dozvoli im samo na users da pristapat do rutite, vo function() callbackot
	Route::group(['middleware' => ['auth']], function(){


		// Route::group(array('prefix' => 'api'), function() {  

			// Route::get('users/{id}', 'UserController@show');

			// Route::get('api/posts', 'PostController@index');


			Route::get('posts', 'PostController@index');

			Route::get('users/{id}','UserController@user_posts')->where('id', '[0-9]+');

		  	Route::post('users/subscribe/{id}', 'UserController@subscribe')->where('id', '[0-9]+');

			Route::get('posts/add', 'PostController@create');

			Route::post('posts/add', 'PostController@store');

			Route::get('posts/{id}',['as' => 'post', 'uses' => 'PostController@show'])->where('id', '[0-9]+');

			Route::get('posts/like/{id}', 'LikeController@store');

			Route::get('posts/unlike/{id}', 'LikeController@destroy');

			Route::post('comments/add', 'CommentController@store');

			Route::post('comments/delete/{id}', 'CommentController@destroy');	

		 // });
		
		  	
		  
	});

 Route::any('{path?}', function() { return view('index'); })->where("path", ".+");

});


// all routes that are not catched before i.e. front-end AngularJS will be catch here.
