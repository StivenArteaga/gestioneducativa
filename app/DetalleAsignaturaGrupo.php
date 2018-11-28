<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAsignaturaGrupo extends Model
{
    //Eliminar esta relación
    protected $table ='detallegruposasignaturas';
    protected $primaryKey ='IdDetalleGrupoAsignatura';
    protected $fillable =['IdGrupo', 'IdAsignatura'];

    public $timestamps = false;
}
