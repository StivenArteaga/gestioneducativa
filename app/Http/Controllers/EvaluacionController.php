<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grado;
use App\Asignatura;
use App\Alumno;
use App\Calificacion;
use App\Evaluacion;
use App\Logro;
use App\Maestro;
use App\DetalleLogroEvaluacion;
use App\Inasistencia;
use Exception;

class EvaluacionController extends Controller
{    
    public function index()
    {
        $grados = Grado::where('EstadoGrado', true)->get();
        $asignaturas = [];
        $alumnos=[];
        $maestro= "";
        $periodoactual ="";
        $asignaturalogro ="";
        $logros =[];
        $notas = Calificacion::where('EstadoNota', true)->get();
        return view('evaluacion.index', compact('grados','asignaturas', 'alumnos', 'notas', 'maestro', 'periodoactual','asignaturalogro','logros'));
    }


    public function listasig($id)
    {
        $asignaturas = Asignatura::join('detalletipogrupoasignaturas', 'asignaturas.IdAsignatura', '=', 'detalletipogrupoasignaturas.IdAsignaturaDetalleTipoGrupoAsignatura')
                                 ->join('tipogrupos', 'detalletipogrupoasignaturas.IdTipoGrupoDetalleTipoGrupoAsignatura', '=', 'tipogrupos.IdTipoGrupo')
                                 ->join('grupos', 'tipogrupos.IdTipoGrupo', '=', 'grupos.IdTipoGrupo')                                 
                                 ->where('asignaturas.EstadoAsignatura', true)
                                 ->where('grupos.IdGrado', '=', $id)
                                 ->where('grupos.EstadoGrupo', true)
                                 ->select('asignaturas.*','grupos.IdGrupo')
                                 ->getQuery()
                                 ->distinct()
                                 ->get(['grupos.IdGrupo']);
        
        return response()->json($asignaturas);
    }

    public function listalumasig($id, $idAsignatura)
    {
        $alumnos = Alumno::join('informacionesacademicas', 'alumnos.IdAlumno', '=', 'informacionesacademicas.IdAlumno')
                         ->join('matriculas', 'alumnos.IdAlumno', '=', 'matriculas.IdAlumno')
                         ->join('grados', 'matriculas.IdGrado', '=', 'grados.IdGrado')
                         ->join('grupos', 'grados.IdGrado', '=', 'grupos.IdGrado')                         
                         ->where('grupos.IdGrupo', '=', $id)
                         ->where('matriculas.IdEstadoMatricula','=', 2)
                         ->where('alumnos.EstadoAlumno','=', true)
                         ->where('grupos.EstadoGrupo','=', true)
                         ->select('alumnos.*', 'informacionesacademicas.Numerolista')
                         ->getQuery()
                         ->distinct()
                         ->get(['informacionesacademicas.IdAlumno']);
        
        $evaluaciones = Evaluacion::join('alumnos', 'evaluaciones.IdAlumno', '=', 'alumnos.IdAlumno')
                                  ->join('matriculas', 'alumnos.IdAlumno', '=', 'matriculas.IdAlumno')
                                  ->join('grados', 'matriculas.IdGrado', '=', 'grados.IdGrado')
                                  ->join('grupos','grados.IdGrado', '=', 'grupos.IdGrado')
                                  ->join('asignaturas', 'evaluaciones.IdAsignatura','=', 'asignaturas.IdAsignatura')
                                  ->where('grupos.IdGrupo', '=', $id)
                                  ->where('evaluaciones.IdAsignatura', '=', $idAsignatura)
                                  ->where('alumnos.EstadoAlumno', '=',true)
                                  ->select('evaluaciones.*')
                                  ->getQuery()
                                  ->get();
                                  

        $notas = Calificacion::where('EstadoNota', '=',true)->get();
        $grados = Grado::where('EstadoGrado','=', true)->get();
        
        /*return view('evaluacion.index', compact('alumnos', 'notas', 'grados'));*/
        return response()->json(['alumnos'=>$alumnos,'notas'=> $notas,'evaluaciones'=>$evaluaciones]);
    }

    public function evalalum($request)
    {         
        try {            
                /*$mi_array = json_decode($request);
                dd($request, $mi_array->idAsignatura);   */
                if ($request != null) {
                    $mi_array = json_decode($request);
                    $evaluacionalumno = Evaluacion::where('IdAlumno', '=', $mi_array->IdAlumno )
                                                  ->where('IdAsignatura', '=', $mi_array->IdAsignatura)
                                                  ->get()->toArray();            
                    
                    if ($evaluacionalumno == []) {                                           
                        if ($mi_array->IdPeriodo == 1) {  

                            $gevaluacion = new Evaluacion();
                            $gevaluacion->IdAlumno = $mi_array->IdAlumno;
                            $gevaluacion->IdPeriodo = $mi_array->IdPeriodo;
                            $gevaluacion->IdAsignatura = $mi_array->IdAsignatura;
                            $gevaluacion->NotaFinal = $mi_array->NotaFinal;
                            $gevaluacion->save();

                            $asistencia = Inasistencia::where('IdAlumno', '=', $mi_array->IdAlumno)
                                                      ->where('IdAsignatura','=', $mi_array->IdAsignatura)
                                                      ->where('IdPeriodo','=', $mi_array->IdPeriodo)
                                                      ->select('inasistencias.*')
                                                      ->first();
                            if($asistencia != null){
                                $asistencia->CantidadInasistencia = "0";
                            }

                            return response()->json(['status'=>'success','message' => 'Alumno evaluado correctamente']);        
                        } else {
                            return response()->json(['status'=>'error','message' => 'No puedes evaluar a un alumno sin haber evaluado los periodos anteriores']);        
                        }                
                    } else {
                        
                        foreach ($evaluacionalumno as $key => $value) {
                                         
                            if ($value['IdPeriodo'] == $mi_array->IdPeriodo) {
                                    $aevaluacion = Evaluacion::where('IdAlumno', '=', $mi_array->IdAlumno)
                                                            ->where('IdPeriodo', '=', $mi_array->IdPeriodo)
                                                            ->first();

                                    $aevaluacion->NotaFinal = $mi_array->NotaFinal;
                                    $aevaluacion->save();

                                    $asistencia = Inasistencia::where('IdAlumno', '=', $mi_array->IdAlumno)
                                                      ->where('IdAsignatura','=', $mi_array->IdAsignatura)
                                                      ->where('IdPeriodo','=', $mi_array->IdPeriodo)
                                                      ->select('inasistencias.*')
                                                      ->first();
                                    if($asistencia != null){
                                        $asistencia->CantidadInasistencia = "0";
                                    }

                                    return response()->json(['status'=>'success','message' => 'La calificación del periodo del alumno fue actualizada correctamente']);        
                            } 
                        }    
                        
                        
                        $periodo = Evaluacion::where('IdAlumno', '=', $mi_array->IdAlumno)
                                             ->where('IdAsignatura','=', $mi_array->IdAsignatura)
                                             ->get();
                        
                        if (count($periodo) <= 1) {                            
                            $ultper;
                            foreach ($periodo as $key => $value) {
                                $ultper = $value->IdPeriodo + 1;
                            }

                            if ($mi_array->IdPeriodo == $ultper) {

                                $nevaluacion = new Evaluacion();
                                $nevaluacion->IdAlumno = $mi_array->IdAlumno;
                                $nevaluacion->IdPeriodo = $mi_array->IdPeriodo;
                                $nevaluacion->IdAsignatura = $mi_array->IdAsignatura;
                                $nevaluacion->NotaFinal = $mi_array->NotaFinal;
                                $nevaluacion->save();

                                $asistencia = Inasistencia::where('IdAlumno', '=', $mi_array->IdAlumno)
                                                      ->where('IdAsignatura','=', $mi_array->IdAsignatura)
                                                      ->where('IdPeriodo','=', $mi_array->IdPeriodo)
                                                      ->select('inasistencias.*')
                                                      ->first();
                                if($asistencia != null){
                                    $asistencia->CantidadInasistencia = "0";
                                }
                
                                return response()->json(['status'=>'success','message' => 'Alumno evaluado correctamente']);        
                            }else{
                                return response()->json(['status'=>'error','message' => 'No puedes evaluar a un alumno sin haber evaluado los periodos anteriores']);        
                            }                                             
                        } else {
                            $valPeriodo = $periodo->last();
                            $ultPeriodo = $valPeriodo->IdPeriodo + 1;    

                            if ($mi_array->IdPeriodo == $ultPeriodo) {

                                $nevaluacion = new Evaluacion();
                                $nevaluacion->IdAlumno = $mi_array->IdAlumno;
                                $nevaluacion->IdPeriodo = $mi_array->IdPeriodo;
                                $nevaluacion->IdAsignatura = $mi_array->IdAsignatura;
                                $nevaluacion->NotaFinal = $mi_array->NotaFinal;
                                $nevaluacion->save();

                                $asistencia = Inasistencia::where('IdAlumno', '=', $mi_array->IdAlumno)
                                                      ->where('IdAsignatura','=', $mi_array->IdAsignatura)
                                                      ->where('IdPeriodo','=', $mi_array->IdPeriodo)
                                                      ->select('inasistencias.*')
                                                      ->first();
                                if($asistencia != null){
                                    $asistencia->CantidadInasistencia = "0";
                                }
                
                                return response()->json(['status'=>'success','message' => 'Alumno evaluado correctamente']);        
                            }else{
                                return response()->json(['status'=>'error','message' => 'No puedes evaluar a un alumno sin haber evaluado los periodos anteriores']);        
                            }                                             
                        }                        
                    }                        
                }else{
                    return response()->json(['status'=>'error','message' => 'Ha ocurrido un error con tu proceso. Recarga la pagina y vuelve hacer el proceso']);        
                }        
          }
          catch (\Exception $e) {
            /*return response()->json(['status'=>'error','message' => 'Ha ocurrido un error con tu proceso. Colocate en contacto con soporte tecnico']);        */
            return response()->json([$e->getMessage()]);        
             /* return $e->getMessage();*/
          }    
        
    }

    public function listalog($IdAsignatura, $IdAlumno)
    {
        try{
            $NombreAsignatura ="";
            $NombreMaestro ="";
            $PeriodoActual ="";
            $NotaFinal ="";
            $logrosasignados;
            $arraylogrosasignados =[];
            
            $evaluacion = Evaluacion::where('IdAsignatura', '=', $IdAsignatura)
                                   ->where('IdAlumno', '=', $IdAlumno)
                                   ->select('evaluaciones.*')
                                   ->get();
                    
            $dteval = $evaluacion->last();                       
            
            if($dteval != null){                        

                $logros = Logro::join('asignaturas','logros.IdAsignatura', '=', 'asignaturas.IdAsignatura')
                                ->join('periodos','logros.IdPeriodo','=','periodos.IdPeriodo')
                                ->join('evaluaciones','periodos.IdPeriodo','=','evaluaciones.IdPeriodo')
                                ->join('detalleasignaturadocente', 'asignaturas.IdAsignatura', '=', 'detalleasignaturadocente.IdAsignaturaDetalleAsignaturaDocente')
                                ->join('maestros','detalleasignaturadocente.IdDocenteDetalleAsignaturaDocente', '=', 'maestros.IdMaestro' )
                                ->where('logros.IdAsignatura', '=', (int)$IdAsignatura)
                                ->where('logros.IdPeriodo','=',$dteval['IdPeriodo'])
                                ->where('evaluaciones.IdPeriodo','=', $dteval['IdPeriodo'])
                                ->where('evaluaciones.IdAsignatura','=',(int)$IdAsignatura)
                                ->where('maestros.EstadoMaestro', '=', true)
                                ->where('logros.EstadoLogro','=',true)   
                                ->where('evaluaciones.IdEvaluacion','=', $dteval['IdEvaluacion'])
                                ->select('logros.*', 'maestros.*','periodos.*','asignaturas.*','evaluaciones.IdEvaluacion')
                                ->distinct()
                                ->get('logros.IdLogro');
                
                if(count($logros) > 0) {

                    $dtulteval = Evaluacion::join('notas','evaluaciones.NotaFinal', '=', 'notas.IdNota')
                                       ->join('periodos','evaluaciones.IdPeriodo','=','periodos.IdPeriodo')
                                       ->where('evaluaciones.IdEvaluacion','=', $dteval['IdEvaluacion'])
                                       ->select('notas.*','periodos.*')
                                       ->first();
                    
                    foreach ($logros as $key => $value) {                                           
                        $NombreAsignatura = $value['NombreAsignatura'];
                        $NombreMaestro = $value['PrimerNombreMaes']." ".$value['PrimerApellidoMaes']." ".$value['SegundoApellidoMaes'];                
                        $PeriodoActual = $dtulteval['NumeroPeriodo'];
                        $NotaFinal = $dtulteval['NombreNota'];

                        
                        $logrosasignados = DetalleLogroEvaluacion::where('IdEvaluacion','=', $dteval['IdEvaluacion'])                                                             
                                                             ->select('IdLogro')
                                                             ->first();
                        
                        $arraylogrosasignados[] = $logrosasignados['IdLogro'];  
                    }                
                    
                    $datos = ([
                        $NombreAsignatura,
                        $NombreMaestro,
                        $PeriodoActual,
                        $NotaFinal
                    ]);
                        
                    return response()->json(['status'=>'success','logros'=>$logros,'datos'=>$datos,'arraylogrosasignados'=>$arraylogrosasignados]);
                }else{
                    return response()->json(['status'=>'error','message' => 'Esta asignatura no tiene logros asignados en este periodo o la asignatura no esa ligada a un docente, por favor dirigete a la opcion logros y asignele a esta asignatura un logro para el periodo actual','logros'=>$logros]);           
                }
            }else{                
                        $logros = Logro::join('asignaturas','logros.IdAsignatura', '=', 'asignaturas.IdAsignatura')
                        ->join('periodos','logros.IdPeriodo','=','periodos.IdPeriodo')
                        ->join('evaluaciones','periodos.IdPeriodo','=','evaluaciones.IdPeriodo')
                        ->join('detalleasignaturadocente', 'asignaturas.IdAsignatura', '=', 'detalleasignaturadocente.IdAsignaturaDetalleAsignaturaDocente')
                        ->join('maestros','detalleasignaturadocente.IdDocenteDetalleAsignaturaDocente', '=', 'maestros.IdMaestro' )
                        ->where('logros.IdAsignatura', '=', $IdAsignatura)
                        ->where('logros.IdPeriodo','=', 1)
                        ->where('evaluaciones.IdPeriodo','=', 1)
                        ->where('evaluaciones.IdAsignatura','=',$IdAsignatura)
                        ->where('maestros.EstadoMaestro', '=', true)
                        ->where('logros.EstadoLogro','=',true)                           
                        ->where('evaluaciones.IdEvaluacion','=', $dteval['IdEvaluacion'])
                        ->select('logros.*', 'maestros.*','periodos.*','asignaturas.*','evaluaciones.IdEvaluacion')
                        ->distinct()
                        ->get('logros.IdLogro');

                        
                        $dtulteval = Evaluacion::join('notas','evaluaciones.NotaFinal', '=', 'notas.IdNota')
                                       ->join('periodos','evaluaciones.IdPeriodo','=','periodos.IdPeriodo')
                                       ->where('evaluaciones.IdEvaluacion','=', $dteval['IdEvaluacion'])
                                       ->select('notas.*','periodos.*')
                                       ->first();
                       
                        foreach ($logros as $key => $value) {                                           
                                $NombreAsignatura = $value['NombreAsignatura'];
                                $NombreMaestro = $value['PrimerNombreMaes']." ".$value['PrimerApellidoMaes']." ".$value['SegundoApellidoMaes'];                
                                $PeriodoActual = $dtulteval['NumeroPeriodo'];
                                $NotaFinal = $dtulteval['NombreNota'];

                                $logrosasignados = DetalleLogroEvaluacion::where('IdEvaluacion','=', $dteval['IdEvaluacion'])                                                             
                                                             ->select('IdLogro')
                                                             ->first();
                                
                                $arraylogrosasignados[] = $logrosasignados['IdLogro'];  
                        }                
                
                        $datos = ([
                            $NombreAsignatura,
                            $NombreMaestro,
                            $PeriodoActual,
                            $NotaFinal
                        ]);                                       
                                       
                if(count($logros) > 0) {
                    return response()->json(['status'=>'success','logros'=>$logros,'datos'=>$datos]);
                }else{
                    return response()->json(['status'=>'error','message' => 'Esta asignatura no tiene logros asignado en este periodo o no le has asignado un docente  a esta asignatura, por favor dirigete a la opcion asignatura y asignele logros a esta asignatura','logros'=>$logros]);           
                }        
            }            
        }catch(\Exception $e){
            return response()->json([$e->getMessage()]);        
        }
    }

    public function savelog($request, $IdEvaluacion)
    {
        try
        {                     
            
            $mi_array = json_decode($request);      
            $mi_id = json_decode($IdEvaluacion);                         
            $array_intlogros = array_map('intval',$mi_array);            
            
            if($mi_array != []){                
                $guardo = false;
                foreach ($array_intlogros as $key => $value) {                    

                    $existe = DetalleLogroEvaluacion::where('IdEvaluacion', '=', (int)$mi_id)
                                                    ->select('detallelogrosevaluaciones.*')
                                                    ->get();                    
                    
                        foreach ($existe as $key => $value1) {                            
                            $elimiar = DetalleLogroEvaluacion::where('IdDetalleLogroEvaluacion','=',$value1['IdDetalleLogroEvaluacion'])->firstOrFail();
                            $elimiar->delete();                                                             
                        }
                        
                        //Convertir dato a entero                                              
                        $detalleevaluacionlogro = new DetalleLogroEvaluacion();
                        $detalleevaluacionlogro->IdLogro = $value;
                        $detalleevaluacionlogro->IdEvaluacion = (int)$mi_id;
                        $detalleevaluacionlogro->save();                               

                    $guardar = true;                                     
                }

                if($guardar == true){
                    return response()->json(['status'=>'success','message' => 'La asignación de logros se realizo satisfactoriamente']);                           
                }else{
                    return response()->json(['status'=>'error','message' => 'Ocurrio un error con tu asignacion de logros a la evaluación, recarga la pagina y vuelve a intentarlo']);                           
                }
            }else{
                return response()->json(['status'=>'error','message' => 'Esta asignatura no tiene un docente asignado, por favor dirigete a la opcion docente y asignele esta asignatura a un maestro']);                           
            }
        }catch(\Exception $e){
            return response()->json([$e->getMessage()]);        
        }
    }

}
