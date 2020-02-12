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

    //Query Scope
    public function scopeNumEnt($query, $num_entrada){

        if($num_entrada){
            return $query->where('num_entrada', 'LIKE', "%$num_entrada%");
        }
    }

    public function scopeAsunto($query, $asunto){

        if($asunto){
            return $query->where('asunto', 'LIKE', "%$asunto%");
        }
    }

    public function scopeReferencia($query, $referencia){

        if($referencia){
            return $query->where('referencia', 'LIKE', "%$referencia%");
        }
    }

}
