<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Usuario;
use App\Evaluacion;
use App\Asignatura;
use App\Materia;
use App\DetalleLogroEvaluacion;
use App\Logro;
use App\Alumno;
use App\Academica;
use App\Grupo;
use App\Jornada;
use App\Grado;
use App\Periodo;
use App\Calificacion;
use App\Inasistencia;
use App\Salon;
use App\Sede;
use App\Coordinador;
use Carbon\Carbon;

class ReporteController extends Controller
{
    public function BoletinAlumno ($IdAlumno, $IdAsignatura)
    {        
        $respuesta = Evaluacion::join('asignaturas as a', 'evaluaciones.IdAsignatura','=','a.IdAsignatura')
                   ->join('materias as m','a.IdMateria','=','m.IdMateria')
                   ->leftjoin('detallelogrosevaluaciones as d','evaluaciones.IdEvaluacion','=','d.IdEvaluacion')
                   ->leftjoin('logros as l','d.IdLogro','=','l.IdLogro')
                   ->join('alumnos as al','evaluaciones.IdAlumno','=','al.IdAlumno')
                   ->join('informacionesacademicas as i','i.IdAlumno','=','al.IdAlumno')
                   ->join('grupos as g','i.IdGrado','=','g.IdGrado')
                   ->join('jornadas as j','g.IdJornada','=','j.IdJornada')
                   ->join('grados as gr','g.IdGrado','=','gr.IdGrado')
                   ->leftjoin('periodos as p','evaluaciones.IdPeriodo','=','p.IdPeriodo')
                   ->join('notas as n','evaluaciones.NotaFinal','=','n.IdNota')
                   ->leftjoin('inasistencias as ina','p.IdPeriodo','=','ina.IdPeriodo')
                   ->join('salones as s', 'g.IdSalon','=','s.IdSalon')
                   ->join('sedes as se','s.IdSede','=','se.IdSede')
                   ->leftjoin('coordinadores as co','co.IdSede','=','se.IdSede')
                   ->where('evaluaciones.IdAlumno','=', $IdAlumno)
                   ->select('j.NombreJornada as NombreJornada' ,'gr.NombreGrado as Grado',  'p.NumeroPeriodo as Periodo',
                   'al.PrimerNombre as PrimerNombreAlumno','al.SegundoNombre as SegundoNombreAlumno',
                   'al.PrimerApellido as PrimerApellidoAlumno',
                   'al.SegundoApellido as SegundoApellidoAlumno','m.NombreMateria', 'a.NombreAsignatura',
                    'l.DescripcionLogro', 'n.NombreNota', 'ina.CantidadInasistencia', 'co.PrimerNombre as PrimerNombreCoordinador',
                    'co.SegundoNombre as SegndoNombreCoordinador','co.PrimerApellido as PrimerApellidoCoordinador',
                    'co.SegundoApellido as SegundoApellidoCoordinador')
                   ->orderBy('evaluaciones.IdPeriodo', 'ASC')->get();                   
        
        // $datos = Alumno::join('evaluaciones', 'alumnos.IdAlumno','=','evaluaciones.IdAlumno')
        //                ->join('detallelogrosevaluaciones','evaluaciones.IdEvaluacion','=','detallelogrosevaluaciones.IdEvaluacion')
        //                ->join('logros','detallelogrosevaluaciones.IdLogro','=','logros.IdLogro')
        //                ->join('asignaturas', 'evaluaciones.IdAsignatura','=','asignaturas.IdAsignatura')
        //                ->join('materias','asignaturas.IdMateria','=','materias.IdMateria')
        //                ->join('periodos','evaluaciones.IdPeriodo','=','periodos.IdPeriodo')
        //                ->where('evaluaciones.IdAlumno','=', (int)$IdAlumno)                                              
        //                ->select('evaluaciones.NotaFinal','logros.DescripcionLogro')
        //                ->get();

        $fecha_actual = Carbon::now();
        $year = $fecha_actual->format('Y');
        
        if(count($respuesta)>0){
            $pdf = \PDF::loadview('reportes.boletin.boletinalumno',['respuesta'=>$respuesta,'año'=>$year]);
            return $pdf->download('boletin.pdf');
        }else{
            return redirect()->route('evaluaciones')->with('error','Antes de descargar el boletín, verifica haber evaluado al alumno y haber asignado sus logros');
        }
    }
}
