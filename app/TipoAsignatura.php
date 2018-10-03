<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAsignatura extends Model
{
    protected $table='tipoasignaturas';
    protected $primaryKey ='IdTipoAsignatura';
    protected $fillable =['NombreTipoAsignatura', 'EstadoTipoAsignatura'];

    public $timestamps = false;
}
