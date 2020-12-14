<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    public function profile()
    {
        return $this->morphOne('App\Profile', 'profileable');
    }
}
