<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleLogroEvaluacion extends Model
{
    protected $table='detallelogrosevaluaciones';
    protected $primaryKey ='IdDetalleLogroEvaluacion';
    protected $fillable =['IdLogro', 'IdEvaluacion'];

    public $timestamps = false;
}
