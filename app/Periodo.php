<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table='periodos';
    protected $primaryKey ='IdPeriodo';
    protected $fillable=['NumeroPeriodo', 'EstadoPeriodos'];

    public $timestamps = false;

}
