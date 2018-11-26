<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inasistencia extends Model
{
    protected $table = 'inasistencias';
    protected $primaryKey ='IdInasistencia';
    protected $fillable =['IdAlumno','IdAsignatura','IdPeriodo','CantidadInasistencia'];

    public $timestamps = false;
}
