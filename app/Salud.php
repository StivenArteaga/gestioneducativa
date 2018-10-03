<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salud extends Model
{
    protected $table='salud';
    protected $primaryKey ='IdSalud';
    protected $fillable = ['IdEps','IdTipoSangre', 'Ips', 'Ars', 'CarnetSisben', 'PuntajeSisben', 'Estrato', 
                        'FuenteRecursos', 'MadreCabFamilia', 'HijoDeMadreCabFamilia', 'BeneVeteranoMilitar', 
                        'BeneHeroeNacional', 'IdVictima', 'FechaExpulsion', 'IdMunicipio','IdResguardo', 
                        'IdEtnia', 'IdAlumno'];


    public $timestamps = false;
}
