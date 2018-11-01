<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Grupo;
use App\Salon;
use App\Grado;
use App\Jornada;
use App\Alumno;
use App\DetalleAsignaturaGrupo;
use App\Asignatura;
use App\TipoCalendario;
use App\Academica;
use App\TipoGrupo;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupos = Grupo::join('salones', 'grupos.IdSalon', '=','salones.IdSalon')
                       ->join('grados', 'grupos.IdGrado', '=', 'grados.IdGrado')
                       ->join('jornadas', 'grupos.IdJornada', '=', 'jornadas.IdJornada')                       
                       ->where('EstadoGrupo', true)
                       ->select('grupos.*', 'salones.NombreSalon', 'grados.NombreGrado', 'jornadas.NombreJornada')
                       ->getQuery()
                       ->get();

        $salones = Salon::where('EstadoSalon', true)->get();                       
        $grados = Grado::where('EstadoGrado', true)->get();
        $jornadas = Jornada::where('EstadoJornada', true)->get();
        $alumnos = Alumno::where('EstadoAlumno', true)->get();
        $tipocalendarios = TipoCalendario::where('EstadoCalendario', true)->get();
        $asignaturas = Asignatura::where('EstadoAsignatura', true)->get();
        $tipogrupos = TipoGrupo::where('EstadoTipoGrupo', '=', true)->get();

        return view('grupo.index', compact('grupos', 'salones', 'grados', 'jornadas', 'alumnos', 'tipocalendarios','asignaturas','tipogrupos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function listalum($id)
    {
        $alumnos = Alumno::join('informacionesacademicas', 'alumnos.IdAlumno', '=', 'informacionesacademicas.IdAlumno')
                        ->join('matriculas','alumnos.IdAlumno','=','matriculas.IdAlumno')
                        ->where('alumnos.EstadoAlumno', true)
                        ->where('matriculas.IdGrado', $id)
                        ->where('matriculas.IdEstadoMatricula','=',2)
                        ->select('alumnos.*')
                        ->getQuery()
                        ->distinct()
                        ->get(['informacionesacademicas.IdGrado']);
                                            
        return response()->json($alumnos);
    }

    
    public function store(Request $request)
    {                    
            if ($request['IdGrupo'] != null) {
                $this->update($request, $request['IdGrupo']);
                return redirect()->route('grupo.index')->with('success','La actualización del grupo se realizo con exito');
            } else {            
        
                $request['FechaGrupo'] = date('Y-m-d H:i:s');
                request()->validate([
                    'IdTipoGrupo'=>'required|int',
                    'IdTipoCalendario'=>'required|int',
                    'IdSalon'=>'required|int',
                    'IdGrado'=>'required|int',
                    'IdJornada'=>'required|int',
                    'EstadoGrupo'=>'required|int'                                      
                ]);        
                
                $grupos = request([
                    'IdTipoCalendario',
                    'IdSalon',
                    'IdGrado',
                    'IdJornada',
                    'FechaGrupo',
                    'EstadoGrupo',
                    'IdTipoGrupo'
                ]);

                $grupoexiste =  Grupo::where('IdGrado', '=',$request['IdGrado'])
                                 ->where('IdTipoCalendario', '=', $request['IdTipoCalendario']) 
                                 ->where('IdJornada', '=', $request['IdJornada'])
                                 ->where('EstadoGrupo', true)                                                               
                                 ->first();
                
                if ($grupoexiste == null) {
                       
                    $cuposalon = Grupo::join('jornadas', 'grupos.IdJornada', '=', 'jornadas.IdJornada')                                          
                                        ->join('tipogrupos', 'tipogrupos.IdTipoGrupo', '=', 'grupos.IdTipoGrupo')
                                        ->join('detalletipogrupoasignaturas', 'tipogrupos.IdTipoGrupo', '=', 'detalletipogrupoasignaturas.IdTipoGrupoDetalleTipoGrupoAsignatura')
                                        ->join('asignaturas', 'detalletipogrupoasignaturas.IdAsignaturaDetalleTipoGrupoAsignatura', '=', 'asignaturas.IdAsignatura')
                                        ->where('grupos.IdSalon', '=', $request['IdSalon'])
                                        ->where('grupos.IdJornada', '=', $request['IdJornada'])
                                        ->where('grupos.EstadoGrupo', '=', true)
                                        ->select('jornadas.*', 'asignaturas.*')
                                        ->get();
                     
                    if(count($cuposalon) > 0){
                            
                            $horasasignaturas =0;
                            $jornada;
                            $totalhorajornada =0;

                            foreach ($cuposalon as $key => $value) {                                  
                                $horasasignaturas = $horasasignaturas + $value['Intensidad'];
                                $horainicio = (new Carbon($value['HoraInicio']))->format('H');
                                $horafin = (new Carbon($value['HoraFin']))->format('H');
                                
                                $totalhorajornada = abs($horainicio-$horafin);                                                                
                            }
                            
                            if($horasasignaturas >= $totalhorajornada){
                                return redirect()->route('grupo.index')->with('error','Este grupo no se puede crear en esta aula. Esta aula ya cumplio con el total de horas de la jornada');    
                            }else{
                                Grupo::create($grupos);                                    
                                return redirect()->route('grupo.index')->with('success','El registro del grupo se realizo con exito');    
                            }
                    }else{      

                        
                        $horasasignaturas =0;
                        $jornada;
                        $totalhorajornada =0;

                        $jornadas = Jornada::where('IdJornada','=', $request['IdJornada'])->first();
                        
                        $intensidad = TipoGrupo::join('detalletipogrupoasignaturas','tipogrupos.IdTipoGrupo','=','detalletipogrupoasignaturas.IdTipoGrupoDetalleTipoGrupoAsignatura')
                                               ->join('asignaturas','detalletipogrupoasignaturas.IdAsignaturaDetalleTipoGrupoAsignatura','=','asignaturas.IdAsignatura')
                                               ->where('tipogrupos.IdTipoGrupo','=',$request['IdTipoGrupo'])
                                               ->where('tipogrupos.EstadoTipoGrupo','=', true)
                                               ->select('asignaturas.*','tipogrupos.*')                                               
                                               ->get();
                        
                        foreach ($intensidad as $key => $value) {                                  
                                $horasasignaturas = $horasasignaturas + $value['Intensidad'];
                                $horainicio = (new Carbon($jornadas['HoraInicio']))->format('H');
                                $horafin = (new Carbon($jornadas['HoraFin']))->format('H');
                                
                                $totalhorajornada = abs($horainicio-$horafin);                                                                
                            }                                               
                           
                           if($horasasignaturas > $totalhorajornada){
                                return redirect()->route('grupo.index')->with('error','Este grupo no se puede crear en esta aula. Esta aula ya cumplio con el total de horas de la jornada');    
                            }else{
                                Grupo::create($grupos);                                    
                                return redirect()->route('grupo.index')->with('success','El registro del grupo se realizo con exito');    
                            }
                    }
                } else {
                    
                    return redirect()->route('grupo.index')->with('error','El grado que le asigno al grupo, ya se encuentra asignado en otro grupo con el mismo calendario y la misma jornada');    
                }                       
            }        
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
        $grupos = Grupo::findOrFail($id);                                
        $alumnos =  Alumno::join('informacionesacademicas', 'alumnos.IdAlumno', '=', 'informacionesacademicas.IdAlumno')
                          ->where('informacionesacademicas.IdGrado', '=', $grupos['IdGrado'])
                          ->select('alumnos.*')
                          ->distinct()
                          ->get(['informacionesacademicas.IdAlumno']);

        return response()->json(['grupos'=>$grupos,'alumnos'=>$alumnos]);
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
        request()->validate([
            'IdTipoGrupo'=>'required|int',
            'IdTipoCalendario'=>'required|int',
            'IdSalon'=>'required|int',
            'IdGrado'=>'required|int',
            'IdJornada'=>'required|int',
            'EstadoGrupo'=>'required|int'                                      
        ]);     
            $request['FechaGrupo'] = date('Y-m-d H:i:s');                   
            
            $grupos = request([
                'IdTipoGrupo',
                'IdTipoCalendario',
                'IdSalon',
                'IdGrado',
                'IdJornada',
                'FechaGrupo',
                'EstadoGrupo'
            ]);
            
            /**El parametros que se le esta enviando en la consulta, no existen registros con esos valores */
            $grupExi =  Grupo::where('IdGrado', '=',$grupos['IdGrado'])
                                ->where('grupos.IdTipoCalendario', '=', $grupos['IdTipoCalendario']) 
                                ->where('IdJornada', '=', $request['IdJornada'])
                                ->where('EstadoGrupo', true) 
                                ->select('grupos.*')                                                              
                                ->first();
                                            
            if ($grupExi == null) {
                
                $cuposalon = Grupo::join('jornadas', 'grupos.IdJornada', '=', 'jornadas.IdJornada')                                          
                                        ->join('tipogrupos', 'tipogrupos.IdTipoGrupo', '=', 'grupos.IdTipoGrupo')
                                        ->join('detalletipogrupoasignaturas', 'tipogrupos.IdTipoGrupo', '=', 'detalletipogrupoasignaturas.IdTipoGrupoDetalleTipoGrupoAsignatura')
                                        ->join('asignaturas', 'detalletipogrupoasignaturas.IdAsignaturaDetalleTipoGrupoAsignatura', '=', 'asignaturas.IdAsignatura')
                                        ->where('grupos.IdSalon', '=', $request['IdSalon'])
                                        ->where('grupos.IdJornada', '=', $request['IdJornada'])
                                        ->where('grupos.EstadoGrupo', '=', true)
                                        ->select('jornadas.*', 'asignaturas.*')
                                        ->get();                    

                
                if(count($cuposalon)==0){
                    
                    $gGrup = Grupo::findOrFail($id);
                                $gGrup->IdTipoGrupo = $grupos['IdTipoGrupo'];
                                $gGrup->IdSalon = $grupos['IdSalon'];
                                $gGrup->IdGrado = $grupos['IdGrado'];
                                $gGrup->IdJornada = $grupos['IdJornada'];
                                $gGrup->IdTipoCalendario = $grupos['IdTipoCalendario'];
                                $gGrup->save();
                                    
                    return redirect()->route('grupo.index')->with('success','La actualización del grupo se realizo con exito');

                }else{
                    
                        $horasasignaturas =0;
                        $jornada;
                        $totalhorajornada =0;
                        $div =0;
                        
                            foreach ($cuposalon as $key => $value) {                                  
                                $horasasignaturas = $horasasignaturas + $value['Intensidad'];
                                $horainicio = (new Carbon($value['HoraInicio']))->format('H');
                                $horafin = (new Carbon($value['HoraFin']))->format('H');
                                
                                $totalhorajornada = abs($horainicio-$horafin);    
                                $div = $div + 1;                                                            
                                
                            }
                            if($div == 0){
                                $div =1;
                            }
                            
                            $horasasignaturas = $horasasignaturas - ($horasasignaturas / $div);
                           
                            if($horasasignaturas ==0){
                                    $horasasignaturas = 1;
                            }
                            if($horasasignaturas >= $totalhorajornada){                                
                                return redirect()->route('grupo.index')->with('error','Este grupo no se puede crear en esta aula. Esta aula ya cumplio con el total de horas de la jornada');    
                            }else{

                                $gGrup = Grupo::findOrFail($id);
                                $gGrup->IdTipoGrupo = $grupos['IdTipoGrupo'];
                                $gGrup->IdSalon = $grupos['IdSalon'];
                                $gGrup->IdGrado = $grupos['IdGrado'];
                                $gGrup->IdJornada = $grupos['IdJornada'];
                                $gGrup->IdTipoCalendario = $grupos['IdTipoCalendario'];
                                $gGrup->save();
                                    
                                return redirect()->route('grupo.index')->with('success','La actualización del grupo se realizo con exito');
                            }
                }
            } else {
                
                if ($grupExi['IdGrupo'] == $id) {

                    $cuposalon = Grupo::join('jornadas', 'grupos.IdJornada', '=', 'jornadas.IdJornada')                                          
                                        ->join('tipogrupos', 'tipogrupos.IdTipoGrupo', '=', 'grupos.IdTipoGrupo')
                                        ->join('detalletipogrupoasignaturas', 'tipogrupos.IdTipoGrupo', '=', 'detalletipogrupoasignaturas.IdTipoGrupoDetalleTipoGrupoAsignatura')
                                        ->join('asignaturas', 'detalletipogrupoasignaturas.IdAsignaturaDetalleTipoGrupoAsignatura', '=', 'asignaturas.IdAsignatura')
                                        ->where('grupos.IdSalon', '=', $request['IdSalon'])
                                        ->where('grupos.IdJornada', '=', $request['IdJornada'])
                                        ->where('grupos.EstadoGrupo', '=', true)
                                        ->select('jornadas.*', 'asignaturas.*')
                                        ->get();                    

                    if(isset($cuposalon)){
                          
                        $horasasignaturas =0;
                        $jornada;
                        $totalhorajornada =0;
                        $div =0;

                            foreach ($cuposalon as $key => $value) {                                  
                                $horasasignaturas = $horasasignaturas + $value['Intensidad'];
                                $horainicio = (new Carbon($value['HoraInicio']))->format('H');
                                $horafin = (new Carbon($value['HoraFin']))->format('H');
                                
                                $totalhorajornada = abs($horainicio-$horafin);    
                                $div = $div + 1;                                                            
                            }
                            if($div == 0){
                                $div =1;
                            }
                            $horasasignaturas = $horasasignaturas - ($horasasignaturas / $div);
                           
                            if($horasasignaturas >= $totalhorajornada){
                                return redirect()->route('grupo.index')->with('error','Este grupo no se puede crear en esta aula. Esta aula ya cumplio con el total de horas de la jornada');    
                            }else{
                                $gGrup = Grupo::findOrFail($id);
                                $gGrup->IdTipoGrupo = $grupos['IdTipoGrupo'];
                                $gGrup->IdSalon = $grupos['IdSalon'];
                                $gGrup->IdGrado = $grupos['IdGrado'];
                                $gGrup->IdJornada = $grupos['IdJornada'];
                                $gGrup->IdTipoCalendario = $grupos['IdTipoCalendario'];
                                $gGrup->save();
                                    
                                return redirect()->route('grupo.index')->with('success','La actualización del grupo se realizo con exito');
                            }
                        }else{               
                            
                            $gGrup = Grupo::findOrFail($id);
                            $gGrup->IdTipoGrupo = $grupos['IdTipoGrupo'];
                            $gGrup->IdSalon = $grupos['IdSalon'];
                            $gGrup->IdGrado = $grupos['IdGrado'];
                            $gGrup->IdJornada = $grupos['IdJornada'];
                            $gGrup->IdTipoCalendario = $grupos['IdTipoCalendario'];
                            $gGrup->save();
                
                            return redirect()->route('grupo.index')->with('success','La actualización del grupo se realizo con exito');
                        }

                } else {
                    return redirect()->route('grupo.index')->with('error','El grado que le asigno al grupo, ya se encuentra asignado en otro grupo');    
                }
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $grupo = Grupo::findOrfail($id);
       if ($grupo != null) {
            if ($grupo->EstadoGrupo == true) {
                $grupo->EstadoGrupo = false;
                $grupo->save();
            }else {
                $grupo->EstadoGrupo = true;
                $grupo->save();
            }
       }else {
        $grupo->EstadoGrupo = false;
        $grupo->save();
       }
        return redirect()->route('grupo.index')->with('success','El grupo fue eliminado con exito ');
    }
}
