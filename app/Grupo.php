<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table ='grupos';
    protected $primaryKey ='IdGrupo';
    protected $fillable =['IdSalon','IdGrado','IdJornada','FechaGrupo' ,'EstadoGrupo', 'IdTipoCalendario'];

    public $timestamps = false;
}
