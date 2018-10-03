<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table ='matriculas';
    protected $primaryKey ='IdMatricula';
    protected $fillable =['IdAlumno', 'IdGrado', 'ValorMatricula', 'IdEstadoMatricula'];

    public $timestamps = false;
}
