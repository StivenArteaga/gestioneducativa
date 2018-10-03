<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
use App\Salon;
use App\Grado;
use App\Jornada;
use App\Alumno;
use App\DetalleAsignaturaGrupo;
use App\Asignatura;
use App\TipoCalendario;
use App\Academica;

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

        return view('grupo.index', compact('grupos', 'salones', 'grados', 'jornadas', 'alumnos', 'tipocalendarios','asignaturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function listalum($id)
    {
        $alumnos = Alumno::join('informacionesacademicas', 'alumnos.IdAlumno', '=', 'informacionesacademicas.IdAlumno')
                        ->where('EstadoAlumno', true)->where('informacionesacademicas.IdGrado', $id)
                        ->select('Alumnos.*')
                        ->getQuery()
                        ->distinct()
                        ->get(['informacionesacademicas.IdGrado']);
                                            
        return response()->json($alumnos);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        if ($request['IdAsignatura']!= null) {
            if ($request['IdGrupo'] != 0) {
                $this->update($request, $request['IdGrupo']);
                return redirect()->route('grupo.index')->with('success','La actualización del grupo se realizo con exito');
            } else {            
        
                $request['FechaGrupo'] = date('Y-m-d H:i:s');
                request()->validate([
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
                    'EstadoGrupo'
                ]);
                $grupExi =  Grupo::where('IdGrado', '=',$grupos['IdGrado'])
                ->where('grupos.IdTipoCalendario', '=', $grupos['IdTipoCalendario']) 
                ->where('EstadoGrupo', true)                                                               
                ->get();

                if (isset($grupExi)) {
                    Grupo::create($grupos);
                    $All = Grupo::all();
                    $IdGrup =$All->last();            

                    foreach ($request['IdAsignatura'] as $key => $value) {                                
                        $detall = ([
                            'IdGrupo',
                            'IdAsignatura'
                        ]);       
                        $detall['IdGrupo'] = $IdGrup['IdGrupo'];
                        $detall['IdAsignatura'] = $value;
                        DetalleAsignaturaGrupo::create($detall);
                    }            

                    return redirect()->route('grupo.index')->with('success','El registro del grupo se realizo con exito');    
                } else {
                    return redirect()->route('grupo.index')->with('danger','El grado que le asigno al grupo, ya se encuentra asignado en otro grupo');    
                }                       
            }
        } else {
                return redirect()->route('grupo.index')->with('danger','Las asignaturas no cumplen con el horario de la jornada');    
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
        $IdGrupo = $grupos['IdGrupo'];        
        $Asignaturas = DetalleAsignaturaGrupo::where('IdGrupo', '=', $IdGrupo)->get()->toArray(); 
        $alumnos =  Alumno::join('informacionesacademicas', 'alumnos.IdAlumno', '=', 'informacionesacademicas.IdAlumno')
                          ->where('informacionesacademicas.IdGrado', '=', $grupos['IdGrado'])
                          ->select('Alumnos.*')
                          ->distinct()
                          ->get(['informacionesacademicas.IdAlumno']);

        return response()->json(['grupos'=>$grupos, 'Asignaturas'=>$Asignaturas, 'alumnos'=>$alumnos]);
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
            'IdTipoCalendario'=>'required|int',
            'IdSalon'=>'required|int',
            'IdGrado'=>'required|int',
            'IdJornada'=>'required|int',
            'EstadoGrupo'=>'required|int'                                      
        ]); 

        if ($request['IdAsignatura'] != null) {
            
            $request['FechaGrupo'] = date('Y-m-d H:i:s');                   
            
            $grupos = request([
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
                                ->where('EstadoGrupo', true)                                                               
                                ->get();
                                
            if (isset($grupExi)) {
                
                $gGrup = Grupo::findOrFail($id);
                $gGrup->IdSalon = $grupos['IdSalon'];
                $gGrup->IdGrado = $grupos['IdGrado'];
                $gGrup->IdJornada = $grupos['IdJornada'];
                $gGrup->IdTipoCalendario = $grupos['IdTipoCalendario'];
                $gGrup->save();
    
                $IdGrupo = Grupo::findOrFail($id);                    
                $DeleteAsig = DetalleAsignaturaGrupo::where('IdGrupo', '=', $id)->get()->toArray(); 
                
                foreach ($DeleteAsig as $key => $value) {
                    $elim = DetalleAsignaturaGrupo::where('IdGrupo','=',$value['IdGrupo'] )->firstOrFail();
                    $elim->delete();
                }
                
                foreach ($request['IdAsignatura'] as $key => $value) {                                
                    $detall = ([
                        'IdGrupo',
                        'IdAsignatura'
                    ]);                                               
                                        
                        $detall['IdGrupo'] = $id;
                        $detall['IdAsignatura'] = $value;
                        DetalleAsignaturaGrupo::create($detall);    
                    
                }        
                
                return redirect()->route('grupo.index')->with('success','La actualización del grupo se realizo con exito');
            } else {
                
                if ($grupExi['IdGrupo'] == $id) {
                    $gGrup = Grupo::findOrFail($id);
                    $gGrup->IdSalon = $grupos['IdSalon'];
                    $gGrup->IdGrado = $grupos['IdGrado'];
                    $gGrup->IdJornada = $grupos['IdJornada'];
                    $gGrup->IdTipoCalendario = $grupos['IdTipoCalendario'];
                    $gGrup->save();
        
                    $IdGrupo = Grupo::findOrFail($id);                    
                    $DeleteAsig = DetalleAsignaturaGrupo::where('IdGrupo', '=', $id)->get()->toArray(); 
                    
                    foreach ($DeleteAsig as $key => $value) {
                        $elim = DetalleAsignaturaGrupo::where('IdGrupo','=',$value['IdGrupo'] )->firstOrFail();
                        $elim->delete();
                    }
                    
                    foreach ($request['IdAsignatura'] as $key => $value) {                                
                        $detall = ([
                            'IdGrupo',
                            'IdAsignatura'
                        ]);                                               
                                            
                            $detall['IdGrupo'] = $id;
                            $detall['IdAsignatura'] = $value;
                            DetalleAsignaturaGrupo::create($detall);                            
                    } 
                } else {
                    return redirect()->route('grupo.index')->with('danger','El grado que le asigno al grupo, ya se encuentra asignado en otro grupo');    
                }
            }
        } else {
            return redirect()->route('grupo.index')->with('danger','Las asignaturas no cumplen con el horario de la jornada al editarlo');    
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
