<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Returns the user that the profile belongs to
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
