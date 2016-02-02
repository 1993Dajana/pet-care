<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{



	 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  pokazhi post so soodvetniot id, zaedno so site negovi komentari
        $user = User::where('id', $id)->first();
        if($user){
            $posts = $user->posts;
        	return view('users.profile')->withUser($user)->withPosts($posts);
        }
    }
}
