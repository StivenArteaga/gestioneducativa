<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table ='instituciones';
    protected $primaryKey ='IdInstituciones';
    protected $fillable =['NombreInstitucion', 'Logo', 'EstadoInstitucion'];

    public $timestamps = false;
}
