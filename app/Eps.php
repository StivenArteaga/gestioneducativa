<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eps extends Model
{
    protected $table='eps';
    protected $primaryKey ='IdEps';
    protected $fillable =['NombreEps'];

    public $timestamps = false;
}
