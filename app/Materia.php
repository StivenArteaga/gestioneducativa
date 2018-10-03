<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table='materias';
    protected $primaryKey='IdMateria';
    protected $fillable=['NombreMateria', 'IdArea', 'DescripcionMateria', 'EstadoMateria'];

    public $timestamps = false;
}
