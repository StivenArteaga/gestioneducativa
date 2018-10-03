<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoVictima extends Model
{
    protected $table ='tipovictimas';
    protected $primaryKey='IdVictima';
    protected $fillable=['NombreTipoVictima'];

    public $timestamps = false;
}
