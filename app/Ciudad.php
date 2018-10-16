<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model  
{
    protected $table='ciudades';
    protected $primaryKey ='IdCiudad';
    protected $fillable=['NombreCiudad', 'IdMunicipio', 'EstadoCiudades'];

    public $timestamps = false;

    public static function ciudades($id) 
    {
        return Ciudad::where('IdCiudad', $id)->get();        
    }
}
