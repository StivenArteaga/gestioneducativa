<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table ='areas';
    protected $primaryKey ='IdArea';
    protected $fillable=['NombreArea','DescripcionArea', 'EstadoArea'];

    public $timestamps = false;
}
