<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    protected $table ='secretarias';
    protected $primaryKey ='IdSecretaria';
    protected $fillable =['PrimerNombreSecretaria', 'SegundoNombreSecretaria','PrimerApellidoSecretaria','SegundoApellidoSecretaria',
                          'IdTipoDocumento', 'NumeroDocumentoSecretaria','CorreoSecretaria','DireccionSecretaria','TelefonoSecretaria',
                          'EstadoSecretaria','IdUserSecretaria', 'IdSede'];
}
