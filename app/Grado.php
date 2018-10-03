<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table='grados';
    protected $primaryKey ='IdGrado';
    protected $fillable =['NombreGrado', 'EstadoGrado'];

    public $timestamps = false;
}
