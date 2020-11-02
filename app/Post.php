<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Returns the user who submitted the post
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Returns the comments on a post
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
