<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    protected $table='jornadas';
    protected $primaryKey ='IdJornada';
    protected $fillable=['NombreJornada','HoraInicio', 'HoraFin' , 'EstadoJornada'];

    public $timestamps = false;
}
