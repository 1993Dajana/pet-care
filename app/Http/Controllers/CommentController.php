<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Posts;
use Log;
use App\User;
use App\Http\Controllers\AuthenticateController;
use File;
use Intervention\Image\Facades\Image as Image;

class CommentController extends Controller
{
      public function __construct()
   {
       // Apply the jwt.auth middleware to all methods in this controller
      
            $this->middleware('jwt.auth');
   }

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
        Log::info($request);
        $comment = new Comments();
        $comment->user_id = $request->user()->id;

        $comment->post_id = $request->get('post_id'); // ->post_id
        $comment->message = $request->get('message');
        $comment->save();
        // return redirect('home')->with('message', 'Comment is succesfully published');
    }


    // OVA NE SE KORISTI, KOMENTARITE GI LOADIRAME PRI ZEMANJE NA POST
    public function loadCommentsForPost($id)
    {
        $comments = Comments::where('post_id', $id)->orderBy('created_at','desc')->get();
         // bidejkji vo baza chuvame samo ime na slika, 
        foreach ($comments as $comment) {
             $comment->user = User::find($comment->user_id);
             $imgName = $comment->user->profile_picture;
             $imgData = base64_encode(File::get('uploads/profile_pictures/' . $imgName));
             $comment->user->profile_picture = $imgData;
        }
        return response()->json(['comments' => $comments]);
    }
}
