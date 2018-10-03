<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAcudiente extends Model
{
    protected $table ='tipoacudientes';
    protected $primaryKey ='IdTipoAcudiente';
    protected $fillable =['NombreTipoAcudiente'];

    public $timestamps = false;
}
