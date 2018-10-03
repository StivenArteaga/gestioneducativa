<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table ='sedes';
    protected $primaryKey ='IdSede';
    protected $fillable = ['NombreSede', 'IdInstitucion', 'EstadoSede'];

    public $timestamps = false;
}
