<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Posts;
use App\User;
use Redirect;
use Log;
use Illuminate\Support\Facades\Input as Input;
use File;
use Intervention\Image\Facades\Image as Image;
use App\Comments;
use App\Likes;

class PostController extends Controller
{
    
     public function __construct()
   {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
    // Log::info('constructor PostController - before');
   $this->middleware('jwt.auth');
        // Log::info('constructor PostController - after');
   }


    /**
     * Display a listing of the resource. This function is handling root request (localhost:8000)
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Posts::orderBy('created_at','desc')->get();// ako sakame del po del mozhe so paginate()
           
        // bidejkji vo baza chuvame samo ime na slika, 
        foreach ($posts as $post) {
            // slika na post
             if($post->post_picture){
                 $imgName = $post->post_picture;
                 $imgData = base64_encode(File::get('uploads/posts/' . $imgName));
                 $post->post_picture = $imgData;
             }
             
             // slika na user koj postiral
             $post->user = $post->author; // tuka smeniv
             $imgName = $post->user->profile_picture;
             if($imgName){
                $imgData = base64_encode(File::get('uploads/profile_pictures/' . $imgName));
             } else {
                $post->user->profile_picture = base64_encode(File::get('uploads/profile_pictures/profile_picture.png'));
             }
              $post->user->profile_picture = $imgData;
             
             $comments = $post->comments;
             // zemi gi slikite na korisnicite koi komentirale
             foreach ($comments as $comment) {
                 $comment->user = User::find($comment->user_id);
                 $imgName = $comment->user->profile_picture;
                 if($imgName){
                    $imgData = base64_encode(File::get('uploads/profile_pictures/' . $imgName));
                } else {
                    $imgData = base64_encode(File::get('uploads/profile_pictures/profile_picture.png'));
                }
                 
                 $comment->user->profile_picture = $imgData;
             }
             $post->comments = $comments;

             // dodaj gi site likes na ovoj post vo response-ot samo kako brojka (poseben servis za koi useri :))
             $post->nComments = count($comments);
             $post->nLikes = count($post->likes);

             // za sekoj post, vo odnos na toa koj user e avtenticiran t.e. go napravil requestot, pushti mu
             // flagche dali vekje go lajknal postot ili ne, za da mozhe da se sredi soodvetno vo angular :)
             
             if(count(Likes::where('post_id', $post->id)->where('user_id', $request->user()->id)->get()) == 1 ){
                    // povekje e greshka
                    $post->liked = true;
             } else {
                    $post->liked = false;
             }

        }
        return response()->json(['posts' => $posts]);
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
        // Log::info($request);
        // Log::info('post store: message is ' . $request->input('message') . ' and address is ' . $request->get('address'));
        // Log::info('or maybe: ' . $request->get('data'));
        // $jap = $request->all();
        // Log::info('countot e: ' . count($jap));
        // Log::info('message is: ' . $request->message);
        // foreach ($jap as $key => $value) {
        //     Log::info('key is: ' . $key . ' and value is ' . $value);
        // }
        $post->message = $request->get('message');
        $post->user_id = $request->user()->id;
        $post->address = $request->get('address');
        $post->longitude = $request->get('longitude');
        $post->latitude = $request->get('latitude');
        $post->type = $request->get('type');
         if(Input::hasFile('post_picture')){
            // imeto
            $file = Input::file('post_picture');
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            /* encoded(username) + timestamp */
            $filename = base64_encode($request->user()->email) . time() .  "." . $extension;
            $file->move('uploads/posts', $filename);
            // resize to fit
            $image = Image::make('uploads/posts/' . $filename);
            $height = $image->height();
            $width = $image->width();
            if($height > $width){
                // vertikalna
                 $image->fit(360, 600);
            } else {
                // horizontalna
                 $image->fit(400, 200);
            }
            $image->save(); // update vo folder
            $post->post_picture = $filename;
        }
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
