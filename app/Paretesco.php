<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paretesco extends Model
{
    protected $table ='parentescos';
    protected $primaryKey='IdParentesco';
    protected $fillable = ['NombreTipoParentesco'];

    public $timestamps = false;
}
