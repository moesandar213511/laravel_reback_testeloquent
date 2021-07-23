<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','title','content'];

    // One to One relation
    public function user(){ // must not s(plural) in user 
		return $this->belongsTo('App\User');
	}

	//polymorphic relation => comment for post
	public function comments(){
		return $this->morphMany('App\Comment','commendable');
	} 

}
