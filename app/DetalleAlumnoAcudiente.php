<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAlumnoAcudiente extends Model
{
   protected $table = 'detallealumnosacudientes';
   protected $primaryKey = 'IdDetalleAlumnoAcudiente';
   protected $fillable = ['IdAcudiente', 'IdTipoAcudiente', 'IdAlumno'];


   public $timestamps = false;
}
