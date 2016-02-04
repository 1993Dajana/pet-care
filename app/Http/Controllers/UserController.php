<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Posts;
use App\Subscriber;
use Illuminate\Http\Request;

class UserController extends Controller {
  /*
   * Display active posts of a particular user
   * 
   * @param int $id - user id
   * @return view
   */
  public function user_posts($id)  
  {
    // $posts = Posts::where('user_id',$id)->orderBy('created_at','desc')->paginate(5);
    $user = User::find($id);
    $posts = $user->posts;
    return response()->json($user);
    // return view('home')->withPosts($posts)->withUser($user);
  }
 
  public function subscribe(Request $request, $id){
        $subscriber = new Subscriber();
        $subscriber->subscriber_id = $request->user()->id;
        $subscriber->user_id = $id;
        $subscriber->save();
  }

  /**
   * profile for user - ova e koga sakas da si go gledas sopstveniot profil i da menuvash neshto :)
     ova valjda ne ni treba :)
   */
  public function profile(Request $request, $id) 
  {
    $data['user'] = User::find($id);
    if (!$data['user'])
      return redirect('/home');
  // ako user-ot koj bara request vakov postoi - ova e za da go dobiesh svojot profil
    if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
      $data['author'] = true;
    } else {
      $data['author'] = null;
    }
    $data['posts_count'] = $data['user'] -> posts -> count();
    $data['latest_posts'] = $data['user'] ->  take(5); // nemora
    // $data['latest_comments'] = $data['user'] -> comments -> take(5);
    return view('users.profile', $data);
  }
}