<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = array('user_id', 'post_id', 'message');

    public function post(){
		return $this->belongsTo('App\Models\Post', 'post_id');
	}

	public function author(){
		return $this->belongsTo('App\User', 'user_id');
	}
}
