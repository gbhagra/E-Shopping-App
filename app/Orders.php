<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    public function user()
    {
        # code...

        return $this->hasOne(User::class);
    }
    
}
