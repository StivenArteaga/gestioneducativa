<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoGrupo extends Model
{
    protected $table ='tipogrupos';
    protected $primaryKey ='IdTipoGrupo';
    protected $fillable =['NombreTipoGrupo', 'EstadoTipoGrupo'];

    public $timestamps = false;
}
