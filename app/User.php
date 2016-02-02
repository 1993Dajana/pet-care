<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'profile_picture', 'skype_id' 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // public function subscribers(){
    //     return $this->hasMany('App\User');
    // }

    public function posts(){
        return $this->hasMany('App\Posts', 'user_id');
    }
}
