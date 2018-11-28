<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
        
    protected $table='users';
    protected $primaryKey ='IdUsers';
    protected $fillable = [
        'email','Contrasena','EstadoUsuario','IdTipoUsuario'
    ]; 
    
    public $timestamps = false;
    
    protected $hidden = [
        'Contrasena',
        'remember_token'
    ];

    public function getAuthPassword()
    {
        return $this->Contrasena;
    }
}
