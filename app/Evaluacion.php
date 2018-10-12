<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table ='evaluaciones';
    protected $primaryKey ='IdEvaluacion';
    protected $fillable =['IdAlumno', 'IdPeriodo', 'IdAsignatura', 'NotaFinal'];

    public $timestamps = false;
}
