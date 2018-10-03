<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table='alumnos';
    protected $primaryKey = 'IdAlumno';
    protected $fillable = ['PrimerNombre', 'SegundoNombre','PrimerApellido','SegundoApellido', 'Correo', 
                        'IdTipoDocumento','NumeroDocumento', 'IdMunicipioExpedido', 'IdGenero',
                        'FechaNacimiento', 'IdCiudadNacimiento', 'IdCiudadResidencia','Direccion','Zona',
                        'Telefono','Usuario','EstadoAlumno'];

                        public $timestamps = false;
}
