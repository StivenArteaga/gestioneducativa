<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table='municipios';
    protected $primaryKey='IdMunicipio';
    protected $fillable=['NombreMunicipio'];

    public $timestamps = false;

    public static function municipios($id) 
    {
        return Municipio::where('IdMunicipio', $id)->get();        
    }
}
