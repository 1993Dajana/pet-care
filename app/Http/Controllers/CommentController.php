<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
     /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comments();
        $comment->user_id = $request->user()->id; // obezbedena avtentikacija ?
        $comment->post_id = $request->get('post_id'); // ->post_id
        $comment->message = $request->get('message');
        $comment->save();
        // return redirect('home')->with('message', 'Comment is succesfully published');
    }
}
