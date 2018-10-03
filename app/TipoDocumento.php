<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table='tipodocumentos';
    protected $primaryKey ='IdTipoDocumento';
    protected $fillable = ['NombreTipoDocumento', 'EstadoTipoDocumento'];

    public $timestamps = false;
}
