<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSangre extends Model
{
    protected $table='tiposangres';
    protected $primaryKey ='IdTipoSangre';
    protected $fillable = ['NombreTipoSangre'];

    public $timestamps = false;
}
