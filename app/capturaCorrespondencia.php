<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class capturaCorrespondencia extends Model
{
    //
    public function promoremit()
    {
        return $this->hasOne('App\promoremit','id');
    }
}
