<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }
}
