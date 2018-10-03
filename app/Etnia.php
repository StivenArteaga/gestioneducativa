<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etnia extends Model
{
    protected $table='etnias';
    protected $primaryKey ='IdEtnias';
    protected $fillable = ['NombreEtnia'];

    public $timestamps = false;
}
