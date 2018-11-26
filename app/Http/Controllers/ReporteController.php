<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Alumno;
use App\Calificacion;
use App\DetalleLogroEvaluacion;
use App\Logro;
use App\Asignatura;
use App\Periodo;

class ReporteController extends Controller
{
    public function BoletinAlumno (Request $request)
    {
        $datos = Alumno::join('evaluaciones', 'alumnos.IdAlumno','=','evaluaciones.IdAlumno')
                       ->join('detallelogrosevaluaciones','evaluaciones.IdEvaluacion','=','detallelogrosevaluaciones.IdEvaluacion')
                       ->join('logros','detallelogrosevaluaciones.IdLogro','=','logros.IdLogro')
                       ->join('asignaturas', 'evaluaciones.IdAsignatura','=','asignaturas.IdAsignatura')
                       ->join('periodos','evaluciones.IdPeriodo','=','periodos.IdPeriodo')
                       ->where('e.IdAlumno','=', $request['IdAlumno'])
                       ->where('e.IdPeriodo','=',$request['IdPeriodo'])
                       ->where('e.IdAsignatura','=',$request['IdAsignatura'])
                       ->select('e.NotaFinal','logros.DescripcionLogro')
                       ->get();

        dd($datos);
    }
}
