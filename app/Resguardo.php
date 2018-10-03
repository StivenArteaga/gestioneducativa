<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resguardo extends Model
{
    protected $table ='resguardos';
    protected $primaryKey='IdResguardos';
    protected $fillable =['NombreResguardo'];

    public $timestamps = false;
}
