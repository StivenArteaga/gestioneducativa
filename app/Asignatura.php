<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table='asignaturas';
    protected $primaryKey='IdAsignatura';
    protected $fillable=['IdMateria', 'NombreAsignatura', 'IdTipoAsignatura',
                        'DescripcionAsignatura','EstadoAsignatura', 'Intensidad'];

    public $timestamps = false;
}
