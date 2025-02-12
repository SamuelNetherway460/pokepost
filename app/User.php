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

    // Returns all of the user's posts
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    // Returns all of a user's comments on all posts
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    // Returns the user's profile
    public function profile()
    {
        return $this->hasOne('\App\Profile');
    }
}
