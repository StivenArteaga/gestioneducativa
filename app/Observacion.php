<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    protected $table = 'observaciones';
    protected $primaryKey = 'IdObservacion';
    protected $fillable = ['IdCoordinador', 'IdAlumno', 'descripcion'];

    public $timestamps = false;
}
