<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academica extends Model
{
    protected $table ='informacionesacademicas';   
    protected $primaryKey ='IdInformacionAcademica';
    protected $fillable =['IdGrado', 'valorPension', 'valorMatricula', 'Numerolista', 'Estado', 'FechaEstado', 
    'CodigoInterno', 'NumeroMatricula', 'InstitucionOrigen', 'EstadoAcademicoAnterior', 'EstadoMatriculaFinal', 
    'CausaTraslado', 'CondicionFinAno','IdAlumno'];

    public $timestamps = false;
}
