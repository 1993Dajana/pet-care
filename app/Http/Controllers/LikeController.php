<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Likes;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthenticateController;

class LikeController extends Controller
{


     public function __construct()
   {
       // Apply the jwt.auth middleware to all methods in this controller
      
            $this->middleware('jwt.auth');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $like = new Likes(); 
        $like->user_id = $request->user()->id;
        $like->post_id = $id;
        $like->save();
        // return redirect('home');
    } 

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)  
    {
       

        $data = [];
        $like = Likes::where('post_id', $id)->where('user_id', $request->user()->id);
        if($like){
        	$like->delete();
        } else {
        	// $data['errors'] = "No permission"; // ubavo bi bilo so errori
        }
        // return redirect('/home')->with($data); 
    }
}
