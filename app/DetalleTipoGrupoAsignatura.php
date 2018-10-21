<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTipoGrupoAsignatura extends Model
{
    protected $table ='detalletipogrupoasignaturas';
    protected $primaryKey ='IdDetalleTipoGrupoAsignatura';
    protected $fillable =['IdTipoGrupoDetalleTipoGrupoAsignatura', 'IdAsignaturaDetalleTipoGrupoAsignatura'];

    public $timestamps = false;
}
