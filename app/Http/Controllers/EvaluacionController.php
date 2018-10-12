<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grado;
use App\Asignatura;
use App\Alumno;
use App\Calificacion;
use App\Evaluacion;
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
        $notas = Calificacion::where('EstadoNota', true)->get();
        return view('evaluacion.index', compact('grados','asignaturas', 'alumnos', 'notas'));
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
