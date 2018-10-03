<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acudiente extends Model
{
    protected $table ='acudientes';
    protected $primaryKey ='IdAcudiente';
    protected $fillable=['PrimerNombreAcu', 'SegundoNombreAcu', 'PrimerApellidoAcu', 'SegundoApellidoAcu', 
    'IdTipoDocumento', 'IdMunicipioExpedicion', 'IdParentesco', 'DireccionHogar', 'TelefonoHogar', 'DireccionTrabajo', 
    'TelefonoTrabajo', 'TelefonoCelular', 'Ocupacion', 'IdUsuario', 'NumeroDocumentoAcu', 'CorreoAcu'];

    public $timestamps = false;
}
