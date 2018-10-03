<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table='generos';
    protected $primaryKey ='IdGenero';
    protected $fillable =['NombreGenero'];

    public $timestamps = false;
}
