<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	// declare polymorphic in Comment model
	// User and Post model call and use.
    public function commendable(){ // write commendable in fun name because it is commendable_id and commendable_type in Comment table
    	return $this->morphTo();
    }
}
