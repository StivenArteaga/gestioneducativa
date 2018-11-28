<?php

namespace App\Http\Controllers;

use App\Inasistencia;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Periodo;
use App\Maestro;
use App\DetalleAsignaturaDocente;
use App\Asignatura;
use App\DetalleAsignaturaGrupo;
use App\Grupo;
use App\Grado;
use App\Academica;
use App\Alumno;
use App\Matricula;
use App\Evaluacion;

class InasistenciaController extends Controller
{
    
    public function index()
    {
        //Consultar las asignaturas de este maestro
        $id = Auth::user()->IdUsers;
        $asignaturas = User::join('maestros','users.IdUsers','=','maestros.IdUser')
                              ->join('detalleasignaturadocente','maestros.IdMaestro','=','detalleasignaturadocente.IdDocenteDetalleAsignaturaDocente')
                              ->join('asignaturas','detalleasignaturadocente.IdAsignaturaDetalleAsignaturaDocente','=','asignaturas.IdAsignatura')
                              ->where('users.IdUsers','=', $id)
                              ->select('asignaturas.*')
                              ->distinct('asignaturas.IdAsignatura')
                              ->get();
        
        return view('inasistencia.index', compact('asignaturas'));
    }

    
    public function grupos($IdAsignatura)
    {
        $IdUsuario = Auth::user()->IdUsers;
        $grupos = Maestro::join('detalleasignaturadocente','maestros.IdMaestro','=','detalleasignaturadocente.IdDocenteDetalleAsignaturaDocente')
        ->join('asignaturas','detalleasignaturadocente.IdAsignaturaDetalleAsignaturaDocente','=','asignaturas.IdAsignatura')
        ->join('detalletipogrupoasignaturas', 'asignaturas.IdAsignatura','=','detalletipogrupoasignaturas.IdAsignaturaDetalleTipoGrupoAsignatura')
        ->join('tipogrupos','detalletipogrupoasignaturas.IdTipoGrupoDetalleTipoGrupoAsignatura','=','tipogrupos.IdTipoGrupo')
        ->join('grupos','tipogrupos.IdTipoGrupo','=','grupos.IdTipoGrupo')
        ->join('grados','grupos.IdGrado','=','grados.IdGrado')
        ->where('maestros.IdUser','=', $IdUsuario)
        ->where('detalletipogrupoasignaturas.IdAsignaturaDetalleTipoGrupoAsignatura','=',(int)$IdAsignatura)
        ->where('grupos.EstadoGrupo','=',1)
        ->select('grupos.*', 'grados.*')
        ->get();
        
        return view('inasistencia.grupos', compact('grupos', 'IdAsignatura'));
    }

    
    public function alumnos($IdGrado, $IdAsignatura)
    {
        $alumnos = Matricula::join('alumnos','matriculas.IdAlumno','=','alumnos.IdAlumno')
                            ->where('matriculas.IdGrado','=', $IdGrado)
                            ->where('matriculas.IdEstadoMatricula','=',2)
                            ->where('alumnos.EstadoAlumno','=',1)
                            ->select('alumnos.*')
                            ->get();
        
        $inasistencias = Inasistencia::all();                
        if(count($inasistencias)>0){
        foreach ($inasistencias as $key => $value1) {                                                                       
                foreach ($alumnos as $key => $value) {                
                    if($value1->IdAlumno == $value->IdAlumno){                        
                        $value->created_at = $value1->CantidadInasistencia;
                    }else{
                        $value->created_at = "0";
                    }
                }            
            } 
        }               
        
        return view('inasistencia.alumnos', compact('alumnos', 'inasistencias','IdAsignatura','FechaInasistencia'));
    }

    
    public function add($alumno, $asignatura)
    {        
        $mi_array = json_decode($alumno);  
        $ultimoperiodo =0;
        
        $periodoactual = Evaluacion::join('periodos','evaluaciones.IdPeriodo','=','periodos.IdPeriodo')
                                   ->where('evaluaciones.IdAlumno','=', $mi_array->IdAlumno)
                                   ->where('evaluaciones.IdAsignatura','=', (int)$asignatura)
                                   ->select('evaluaciones.*')
                                   ->get();
        
        if(count($periodoactual) > 0){
            foreach($periodoactual as $key => $value) {
                $ultimoperiodo = $value['IdPeriodo'];
            }
        }else{
            $ultimoperiodo =0;
        }
        
        $ultimoperiodo = $ultimoperiodo+1;

        $existe = Inasistencia::where('IdAlumno','=',$mi_array->IdAlumno)
                              ->where('IdPeriodo','=', $ultimoperiodo)
                              ->select('inasistencias.*')
                              ->first();
        
        if($existe == null){          
            $gInasistencia = new Inasistencia();
            $gInasistencia->IdAlumno = $mi_array->IdAlumno;
            $gInasistencia->IdAsignatura = (int)$asignatura;
            $gInasistencia->IdPeriodo = $ultimoperiodo;            
            $gInasistencia->CantidadInasistencia = $gInasistencia->CantidadInasistencia+1;            
            $gInasistencia->save();
            
            $url = Academica::where('IdAlumno','=', $mi_array->IdAlumno)->select('informacionesacademicas.*')->first();
            
            $path = 'inasistencia/grado/'.$url['IdGrado'].'/'.(int)$asignatura;
            return Redirect::to($path)->with('success','Su inasistencia se ha aplicado correctamente', $gInasistencia->CantidadInasistencia);
            
        }else{            
            if($ultimoperiodo == 4){
                $existe->IdPeriodo = 4;
            }else{
                $existe->IdPeriodo = $ultimoperiodo;
            }
            $existe->CantidadInasistencia = $existe->CantidadInasistencia+1;            
            $existe->save();            
            
            $url = Academica::where('IdAlumno','=', $mi_array->IdAlumno)->select('informacionesacademicas.*')->first();
            
            $path = 'inasistencia/grado/'.$url['IdGrado'].'/'.(int)$asignatura;
            return Redirect::to($path)->with('success','Su inasistencia se ha aplicado correctamente', $existe->CantidadInasistencia);
        }
    }
}
