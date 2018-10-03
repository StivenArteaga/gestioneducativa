<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table='usuarios';
    protected $primaryKey ='IdUsuario';
    protected $fillable=['NombreUsuario','Contrasena', 'TipoUsuario', 'IdInstitucion'];
}
