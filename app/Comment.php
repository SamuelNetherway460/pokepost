<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Returns the user who posted the comment
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Returns the post which was commented on
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
