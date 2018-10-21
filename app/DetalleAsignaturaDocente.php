<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAsignaturaDocente extends Model
{
    protected $table ='detalleasignaturadocente';
    protected $primaryKey ='IdDetalleAsignaturaDocente';
    protected $fillable=['IdAsignaturaDetalleAsignaturaDocente', 'IdDocenteDetalleAsignaturaDocente'];

    public $timestamps = false;
}
