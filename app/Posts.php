<?php

namespace App;

// KAJ hasMany VTORIOT ARGUMENT E FOREIGN KEY VO TABELATA SHTO E PRV ARGUMENT
// KAJ belongsTo VTORIOT ARGUMENT E FOREIGN KEY NA MOMENTALNATA TABELA
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $guarded = [];


	public function comments(){
		return $this->hasMany('App\Comments', 'post_id');	 // ova post_id, eloquent bi trebalo da go locira sam
		// bidejkji se shto e so *_id se podrazbira deka e foreign. Inaku post_id e nadvoreshen kluch vo tabelata comments 
	}

	/*
		mi vrakja instanca na avtorot - userot koj go napishal postot, za polesno da rabotam vo aplikacijata. Ovoj avtor e red od 
		tabelata users.
	*/
	public function author(){
		return $this->belongsTo('App\User', 'user_id');		// tuka za razlika od hasMany, vtoriot argument e nadvoreshniot kluch na
		// postot
	}

	// likes
	public function likes(){
		return $this->hasMany('App\Likes', 'post_id');
	}

}
