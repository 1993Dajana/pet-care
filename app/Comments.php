<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = array('user_id', 'post_id', 'message');

    public function post(){
		return $this->belongsTo('App\Posts', 'post_id');
	}

	public function author(){
		return $this->belongsTo('App\User', 'user_id');
	}
}
