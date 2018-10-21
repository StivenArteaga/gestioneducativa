<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    protected $table='maestros';
    protected $primaryKey ='IdMaestro';
    protected $fillable=['PrimerNombreMaes', 'SegundoNombreMaes','PrimerApellidoMaes', 'SegundoApellidoMaes', 
                        'IdTipoDocumento','NumeroDocumento','FechaNacimiento', 'IdGenero','IdTipoSangre', 'Correo',
                        'Direccion', 'Telefono', 'IdCiudad', 'Especializacion', 'Escalafon', 'Coordinador','EstadoMaestro'
                        ];

    public $timestamps = false;
}
