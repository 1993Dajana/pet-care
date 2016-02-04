<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Posts;
use App\User;
use Redirect;


class PostController extends Controller
{
    
    /**
     * Display a listing of the resource. This function is handling root request (localhost:8000)
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Posts::where('type','found')->orderBy('created_at','desc')->paginate(30); // ako sakame del po del mozhe so paginate()
        $user = $request->user();
        $posts = $user->posts;
        return response()->json($user);
        // return view('home')->withPosts($posts)->withUser($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('posts.create'); 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Posts(); // model
        $post->message = $request->get('message');
        $post->user_id = $request->user()->id;
        $post->address = "dwd";
        $post->longitude = 12;
        $post->latitude = 12;
        $post->post_picture = "2323";
        $post->type = "found";
        $post->save();
        // return redirect('home');
    }  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  pokazhi post so soodvetniot id, zaedno so site negovi komentari
        $post = Posts::where('id', $id)->first();
        if(!$post){
                // ne postoi toj post, vrakja 500 error           
        }
        $comments = $post->comments;
        $likes = $post->likes;
        return response()->json($post, 200);
                 // ->setCallback($request->input('callback'));
        // return view('posts.show')->withPost($post)->withComments($comments);
     
    }
}
