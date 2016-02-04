<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    
    public function author(){
		return $this->belongsTo('App\User', 'user_id');
	}

	public function post(){
		return $this->belongsTo('App\Posts', 'post_id');
	}
}
