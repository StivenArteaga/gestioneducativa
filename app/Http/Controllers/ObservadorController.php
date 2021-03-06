<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use Illuminate\Support\Facades\Auth;
use App\Alumno;
use App\Evaluacion;
use App\Periodo;
use App\Observacion;
use App\Coordinador;

class ObservadorController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'alumno'], ['only' => ['index']]);
    // }

    public function observaciones()
    {
        $observaciones = Observacion::select('observaciones.*', 'coordinadores.PrimerNombre as nombre', 'coordinadores.PrimerApellido as apellido', 'alumnos.*')
        ->join('coordinadores', 'coordinadores.IdCoordinador', 'observaciones.IdCoordinador')
        ->join('alumnos', 'alumnos.IdAlumno', 'observaciones.IdAlumno')
        ->get();
        return view('observaciones.index', compact('observaciones', 'alumnos'));
    }
    
    public function index()
    {
        if(Auth::user()->IdTipoUsuario == 6) {
            $id = Alumno::select('alumnos.IdAlumno')->join('detallealumnosacudientes', 'alumnos.IdAlumno', 'detallealumnosacudientes.IdAlumno')->join('acudientes', 'acudientes.IdAcudiente', 'detallealumnosacudientes.IdAcudiente')->first();

            $alumno = Alumno::select('alumnos.*', 'tipodocumentos.NombreTipoDocumento', 'municipios.NombreMunicipio', 'generos.NombreGenero')
            ->join('tipodocumentos', 'tipodocumentos.IdTipoDocumento', 'alumnos.IdTipoDocumento')
            ->join('municipios', 'municipios.IdMunicipio', 'alumnos.IdMunicipioExpedido')
            ->join('generos', 'generos.IdGenero', 'alumnos.IdGenero')
            ->where('alumnos.IdAlumno', $id->IdAlumno)
            ->first();

            $observaciones = Observacion::where('alumnos.Usuario', $id)
            ->join('coordinadores', 'coordinadores.IdCoordinador', 'observaciones.IdCoordinador')
            ->join('alumnos', 'alumnos.IdAlumno', 'observaciones.IdAlumno')
            ->join('users', 'users.IdUsers','alumnos.Usuario')
            ->select('coordinadores.*', 'observaciones.descripcion')->get();
            
            $periodos = Periodo::pluck('NumeroPeriodo', 'IdPeriodo');

            return view('alumno.observador', compact('alumno','periodos', 'observaciones'));
        } else if(Auth::user()->IdTipoUsuario == 5) {

            $id = Auth::user()->IdUsers;
            $alumno = Alumno::select('alumnos.*', 'tipodocumentos.NombreTipoDocumento', 'municipios.NombreMunicipio', 'generos.NombreGenero')
            ->join('tipodocumentos', 'tipodocumentos.IdTipoDocumento', 'alumnos.IdTipoDocumento')
            ->join('municipios', 'municipios.IdMunicipio', 'alumnos.IdMunicipioExpedido')
            ->join('generos', 'generos.IdGenero', 'alumnos.IdGenero')
            ->join('users', 'users.IdUsers','alumnos.Usuario')
            ->where('alumnos.Usuario', $id)
            ->first();

            $observaciones = Observacion::where('alumnos.Usuario', $id)
            ->join('coordinadores', 'coordinadores.IdCoordinador', 'observaciones.IdCoordinador')
            ->join('alumnos', 'alumnos.IdAlumno', 'observaciones.IdAlumno')
            ->join('users', 'users.IdUsers','alumnos.Usuario')
            ->select('coordinadores.*', 'observaciones.descripcion')->get();
            
            $periodos = Periodo::pluck('NumeroPeriodo', 'IdPeriodo');
    
            return view('alumno.observador', compact('alumno','periodos', 'observaciones'));
        } else {
            return redirect('/');
        }
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

    public function inasistenciasTabla($valor){
        $id = Auth::user()->IdUsers;
        $inasistencias = Evaluacion::where('periodos.IdPeriodo',$valor)->where('alumnos.Usuario', $id)
        ->where('inasistencias.IdPeriodo', $valor)
        ->join('alumnos', 'alumnos.IdAlumno','Evaluaciones.IdAlumno')
        ->join('periodos','periodos.IdPeriodo','evaluaciones.IdPeriodo')
        ->join('asignaturas','asignaturas.IdAsignatura','Evaluaciones.IdAsignatura')
        ->join('materias','materias.IdMateria','asignaturas.IdMateria')
        ->join('notas','notas.IdNota','evaluaciones.NotaFinal')
        ->join('users', 'users.IdUsers','alumnos.Usuario')
        ->join('inasistencias','inasistencias.IdAsignatura','asignaturas.IdAsignatura')
        ->select('inasistencias.CantidadInasistencia','notas.NombreNota','periodos.NumeroPeriodo','materias.NombreMateria')->get();
        return response()->json(["data" => $inasistencias]);
    }

    public function create()
    {
        $alumnos = Alumno::all();
        return view('observaciones.create', compact('alumnos'));
    }

    public function store(Request $request)
    {   
        $id = Auth::user()->IdUsers;
        
        $coordinador = Coordinador::where('coordinadores.IdCoordinador', $id)
        ->join('users', 'users.IdUsers', 'coordinadores.IdUser')
        ->select('coordinadores.IdCoordinador')
        ->first();
        if($coordinador == null){
            return redirect('observaciones')->with('error','Este usuario no tiene permisos para realizar esta acción. Rol requerido "Coordinador"');      
        }else{
            $this->validate($request, [
                'IdAlumno' => 'required',
                'descripcion' => 'required|string|max:800'
            ]);
    
            $observacion = new Observacion();
            $observacion->IdCoordinador = $coordinador->IdCoordinador;
            $observacion->IdAlumno = $request->get('IdAlumno');
            $observacion->descripcion = $request->get('descripcion');
            $observacion->save();
    
            return redirect('observaciones');
        }               
    }

    public function edit($id)
    {
        $observaciones = Observacion::findOrFail($id);
        $alumnos = Alumno::pluck('PrimerNombre', 'IdAlumno');
        return view('observaciones.edit', compact('observaciones', 'alumnos'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user()->IdUsers;
        $coordinador = Coordinador::where('coordinadores.IdCoordinador', $user)
        ->join('users', 'users.IdUsers', 'coordinadores.IdUser')
        ->select('coordinadores.IdCoordinador')
        ->first();

        if($coordinador == null){
            return redirect()->route('observacion.index')->with('error','Este usuario no tiene permisos para realizar esta acción. Rol requerido "Coordinador"');            
        }else{
        $this->validate($request, [
            'IdAlumno' => 'required',
            'descripcion' => 'required|string|max:800'
        ]);
        $observaciones = Observacion::findOrFail($id);
        $observaciones->IdCoordinador = $coordinador->IdCoordinador;
        $observaciones->IdAlumno = $request->get('IdAlumno');
        $observaciones->descripcion = $request->get('descripcion');
        $observaciones->save();

        return redirect('observaciones');
        }
    }
}
