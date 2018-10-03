<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAsignaturaGrupo extends Model
{
    protected $table ='detallegruposasignaturas';
    protected $primaryKey ='IdDetalleGrupoAsignatura';
    protected $fillable =['IdGrupo', 'IdAsignatura'];

    public $timestamps = false;
}
