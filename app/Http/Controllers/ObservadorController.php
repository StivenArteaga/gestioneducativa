<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use Illuminate\Support\Facades\Auth;
use App\Alumno;
use App\Evaluacion;
use App\Periodo;
use App\Observacion;

class ObservadorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'alumno']);
    }
    
    public function index()
    {
        
        $id = Auth::user()->IdUsers;
        $alumno = Alumno::select('alumnos.*', 'tipodocumentos.NombreTipoDocumento', 'municipios.NombreMunicipio', 'generos.NombreGenero')
        ->join('tipodocumentos', 'tipodocumentos.IdTipoDocumento', 'alumnos.IdTipoDocumento')
        ->join('municipios', 'municipios.IdMunicipio', 'alumnos.IdMunicipioExpedido')
        ->join('generos', 'generos.IdGenero', 'alumnos.IdGenero')
        ->join('users', 'users.IdUsers','alumnos.Usuario')
        ->where('alumnos.Usuario', $id)
        ->first();

        $observaciones = Observacion::where('alumnos.Usuario', $id)
        ->join('maestros', 'maestros.IdMaestro', 'observaciones.IdMaestro')
        ->join('alumnos', 'alumnos.IdAlumno', 'observaciones.IdAlumno')
        ->join('users', 'users.IdUsers','alumnos.Usuario')
        ->select('maestros.*', 'observaciones.descripcion')->get();
        
        $periodos = Periodo::pluck('NumeroPeriodo', 'IdPeriodo');

        return view('alumno.observador', compact('alumno','periodos', 'observaciones'));
    }

    public function cargarTablaNotas($valor){
        $id = Auth::user()->IdUsers;
        $notas = Evaluacion::where('periodos.IdPeriodo',$valor)->where('alumnos.Usuario', $id)
        ->join('alumnos', 'alumnos.IdAlumno','Evaluaciones.IdAlumno')
        ->join('periodos','periodos.IdPeriodo','evaluaciones.IdPeriodo')
        ->join('asignaturas','asignaturas.IdAsignatura','Evaluaciones.IdAsignatura')
        ->join('materias','materias.IdMateria','asignaturas.IdMateria')
        ->join('notas','notas.IdNota','evaluaciones.NotaFinal')
        ->join('users', 'users.IdUsers','alumnos.Usuario')
        ->select('notas.NombreNota','periodos.NumeroPeriodo','materias.NombreMateria')->get();
      
          return response()->json(["data" => $notas]);
    }
}
