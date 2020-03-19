<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class turno extends Model
{
    //
    protected $fillable = ['oficio','fecha_turno','turnado_a','turnado_por','instruccion_adicional','instruccion','semaforo','respuesta_auto','compromiso_date'];
}
