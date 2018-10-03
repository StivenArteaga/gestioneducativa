<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table='departamentos';
    protected $primaryKey='IdDepartamento';
    protected $fillable=['NombreDepartamento'];

    public $timestamps = false;
}
