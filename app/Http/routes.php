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

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
   
    Route::auth();

    Route::get('home', 'HomeController@index');

    // dozvoli im samo na users da pristapat do rutite, vo function() callbackot
	Route::group(['middleware' => ['auth']], function(){

		// POSTS
			// pokazhi ja formata za kreiranje na nov post
			Route::get('create-post', 'PostController@create');

			// otkoga ti e pokazhana formata i si kliknal submit, zachuvaj go postot
			Route::post('create-post', 'PostController@store');
	});
});
