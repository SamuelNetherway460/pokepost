<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public function profile()
    {
        return $this->morphOne('App\Profile', 'profileable');
    }
}
