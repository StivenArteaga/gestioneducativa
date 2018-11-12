<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use Illuminate\Support\Facades\Auth;
use App\Alumno;
use App\Evaluacion;
use App\Periodo;

class ObservadorController extends Controller
{

    public function index()
    {
        
            $id = Auth::user()->IdUsers;
            $alumno = Alumno::select('alumnos.*', 'tipodoc.NombreTipoDocumento', 'municipio.NombreMunicipi')
            ->where('alumnos.IdAlumno', $id);
            
            $notas = Evaluacion::where('alumnos.IdAlumno', 4)->join('alumnos', 'alumnos.IdAlumno','Evaluaciones.IdAlumno')->join('periodos','periodos.IdPeriodo','evaluaciones.IdPeriodo')
            ->join('asignaturas','asignaturas.IdAsignatura','Evaluaciones.IdAsignatura')
            ->join('materias','materias.IdMateria','asignaturas.IdMateria')
            ->join('notas','notas.IdNota','evaluaciones.NotaFinal')
            ->select('notas.NombreNota','periodos.NumeroPeriodo','materias.NombreMateria')->get();

            $periodos = Periodo::pluck('NumeroPeriodo', 'IdPeriodo');

            // dump($notas);s
        return view('alumno.observador', compact('alumno','notas','periodos'));
    }

    public function cargarTablaNotas(){
        dump('cargar notas controller');
    }
}
