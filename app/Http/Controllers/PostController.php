<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use App\Http\Requests\PostFormRequest;

class PostController extends Controller
{
    
    /**
     * Display a listing of the resource. This function is handling root request (localhost:8000)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('posts.add'); 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post(); // model
        $post->message = $request->get('body');
        $post->user_id = $request->user()->id;
        return redirect('home');
    }  
}
