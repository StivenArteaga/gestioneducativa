<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{ 
    protected $table ='notas';
    protected $primaryKey ='IdNota';
    protected $fillable =['NombreNota', 'EstadoNota'];

    public $timestamps = false;
}
