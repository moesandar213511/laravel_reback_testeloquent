<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // hasMany relation (user and post table)
    public function posts(){
        return $this->hasMany('App\Post');
    }

    // hasOne relation (user, post and city table)
    public function city(){
        return $this->hasOne('App\City');
    }

    // many to many relation (user, role and role_user table)
    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    // polymorphic relation => comment for user
    public function comments(){
        return $this->morphMany('App\Comment','commendable'); // ('App\Comment Model','commendable function in comment model');
    }


}
