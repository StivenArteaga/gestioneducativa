<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $table='salones';
    protected $primaryKey = 'IdSalon';
    protected $fillable = ['NombreSalon', 'IdSede', 'EstadoSalon'];

    public $timestamps = false;
}
