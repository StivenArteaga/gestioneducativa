<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    protected $table = 'coordinadores';
    protected $primaryKey = 'IdCoordinador';
    protected $fillable = ['Nombres', 'Apellidos', 'IdUser'];
}
