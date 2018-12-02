<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    protected $table = 'coordinadores';
    protected $primaryKey = 'IdCoordinador';
    protected $fillable = ['PrimerNombre', 'SegundoNombre', 'PrimerApellido', 'SegundoApellido', 'IdTipoDocumento', 'NumeroDocumento', 'FechaNacimiento', 'IdGenero', 'IdTipoSangre', 'Correo', 'Direccion', 'Telefono', 'IdMunicipio', 'IdSede', 'IdUser', 'Estado'];

    public $timestamps = false;
}
