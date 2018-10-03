<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logro extends Model
{
    protected $table='logros';
    protected $primaryKey ='IdLogro';
    protected $fillable=['DescripcionLogro', 'IdPeriodo', 'IdAsignatura', 'EstadoLogro'];

    public $timestamps = false;
}
