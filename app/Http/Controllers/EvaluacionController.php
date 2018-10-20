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
use Exception;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $asignaturas = Asignatura::join('detallegruposasignaturas', 'asignaturas.IdAsignatura', '=', 'detallegruposasignaturas.IdAsignatura')
                                 ->join('grupos', 'detallegruposasignaturas.IdGrupo', '=', 'grupos.IdGrupo')                                 
                                 ->where('EstadoAsignatura', true)
                                 ->where('grupos.IdGrado', '=', $id)
                                 ->where('EstadoGrupo', true)
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
                         ->where('alumnos.EstadoAlumno', true)
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
                                  ->where('alumnos.EstadoAlumno', true)
                                  ->select('evaluaciones.*')
                                  ->getQuery()
                                  ->get();
                                  

        $notas = Calificacion::where('EstadoNota', true)->get();
        $grados = Grado::where('EstadoGrado', true)->get();
        
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
                    $evaluacionalumno = Evaluacion::where('IdAlumno', '=', $mi_array->IdAlumno )->get()->toArray();            
                    if ($evaluacionalumno == []) {                   
                        if ($mi_array->IdPeriodo == 1) {  

                            $gevaluacion = new Evaluacion();
                            $gevaluacion->IdAlumno = $mi_array->IdAlumno;
                            $gevaluacion->IdPeriodo = $mi_array->IdPeriodo;
                            $gevaluacion->IdAsignatura = $mi_array->IdAsignatura;
                            $gevaluacion->NotaFinal = $mi_array->NotaFinal;
                            $gevaluacion->save();

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

                                    return response()->json(['status'=>'success','message' => 'La calificación del periodo del alumno fue actualizada correctamente']);        
                            } 
                        }    
                        
                        $periodo = Evaluacion::where('IdAlumno', '=', $mi_array->IdAlumno)
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
            
            $evaluacion = Evaluacion::where('IdAsignatura', '=', $IdAsignatura)
                                   ->where('IdAlumno', '=', $IdAlumno)
                                   ->get();
                                   
            $dteval = $evaluacion->last();                       
            
            $logros = Logro::join('asignaturas','logros.IdAsignatura', '=', 'asignaturas.IdAsignatura')
                           ->join('maestros','asignaturas.IdAsignatura', '=', 'maestros.IdAsignatura' )
                           ->where('logros.IdAsignatura', '=', $IdAsignatura)
                           ->where('logros.IdPeriodo','=',$dteval['IdPeriodo'])
                           ->select('logros.*', 'maestros.*')
                           ->get();

            foreach ($logros as $key => $value) {
                $value['EstadoLogro'] = $dteval['IdEvaluacion'];
            }

            if(count($logros) > 0) {
                return response()->json(['status'=>'success','logros'=>$logros]);
            }else{
                return response()->json(['status'=>'error','message' => 'Esta asignatura no tiene un docente asignado, por favor dirigete a la opcion docente y asignele esta asignatura a un maestro']);           
            }
        }catch(\Exception $e){
            return response()->json([$e->getMessage()]);        
        }
    }

    public function savelog($request, $IdEvaluacion){
        try
        {            
            $mi_array = json_decode($request);      
            $mi_id = json_decode($IdEvaluacion);      
            if($mi_array != []){                
                $guardo = false;
                foreach ($mi_array as $key => $value) {

                    $existe = DetalleLogroEvaluacion::where('IdLogro', '=', $value)
                                                    ->where('IdEvaluacion', '=', $mi_id)
                                                    ->get();                    
                    if(count($existe) <= 0){
                        $detalleevaluacionlogro = new DetalleLogroEvaluacion();
                        $detalleevaluacionlogro->IdLogro = $value;
                        $detalleevaluacionlogro->IdEvaluacion = $mi_id;
                        $detalleevaluacionlogro->save();                               
                    }                                   
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

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
