<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCalendario extends Model
{
    protected $table ='tipoalendarios';
    protected $primaryKey ='IdTipoCalendario';
    protected $fillable=['NombreCalendario', 'EstadoCalendario'];

    public $timestamps = false;
}
