<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jornada;
use Carbon\Carbon;
use Exception;

class JornadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jornadas = Jornada::where('EstadoJornada', true)->get();
        return view('jornada.index', compact('jornadas'));
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
        if ($request['IdJornada'] != 0) {
            $this->update($request, $request['IdJornada']);
            return redirect()->route('jornada.index')->with('success','La jornada se actualizo con exito');
        } else {       
            $logros = request()->validate([
                'NombreJornada'=>'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+$/',               
                'HoraInicio'=>'required',     
                'HoraFin'=>'required',     
                'EstadoJornada'=>'required|int',    
            ]);

            $existe = Jornada::where('NombreJornada', '=', $request['NombreJornada'])
                              ->where('EstadoJornada', '=', true)
                              ->first();

            if($existe != null){
                return redirect()->route('jornada.index')->with('error','El nombre de esta jornada ya se encuentra registrado');
            }else{                                        
                if ($request['HoraFin'] <= $request['HoraInicio']) {
                    return redirect()->route('jornada.index')->with('error','La hora fin no puede ser menor o igual a la hora de inicio en una jornada'.' '.'Hora de inicio: '.$request['HoraInicio'].'-'.'Hora fin: '.$request['HoraFin']);
                } else {
                    $valHora = Jornada::where('EstadoJornada', true)->get();
                    $cont = true;
                    foreach ($valHora as $key => $value) {            
                        if (($request['HoraInicio'] >= $value['HoraFin'])&& ($request['HoraFin'] <= $value['HoraInicio'])||
                            ($request['HoraInicio'] < $value['HoraFin'])&& ($request['HoraFin'] <= $value['HoraInicio'])||
                            ($request['HoraInicio'] >= $value['HoraFin'])&& ($request['HoraFin'] > $value['HoraInicio']) ) {
                            $cont = true;                            
                        } else {
                            $cont = false;               
                            break;
                        }            
                    }      
    
                    if ($cont) {

                        $request['HoraInicio'] = ((new Carbon($request['HoraInicio']))->format('H') == '00') ? (new Carbon($request['HoraInicio']))->format('h:i:s') : (new Carbon($request['HoraInicio']))->format('H:i:s');
                        $request['HoraFin'] = ((new Carbon($request['HoraFin']))->format('H') == '00') ? (new Carbon($request['HoraFin']))->format('h:i:s') : (new Carbon($request['HoraFin']))->format('H:i:s');
                        $request['HoraInicio'] = (new Carbon($request['HoraInicio']))->toTimeString();
                        $request['HoraFin'] = (new Carbon($request['HoraFin']))->toTimeString();
                            
                        Jornada::create($request->all());
                        return redirect()->route('jornada.index')->with('success','La jornada se registro con exito');  
                    } else {
                        return redirect()->route('jornada.index')->with('error','Ya existe una jornada que contiene un rango de horas entre '.$request['HoraInicio'].'-'.$request['HoraFin']);
                    }    
                }  
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
        $jornadas = Jornada::findOrFail($id);        
        return response()->json($jornadas);
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
        $logros = request()->validate([
            'NombreJornada'=>'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+$/|unique:jornadas,NombreJornada,'.$id.',IdJornada,EstadoJornada,'.true,
            'HoraInicio'=>'required|unique:jornadas,HoraInicio,'.$id.',IdJornada,EstadoJornada,'.true,
            'HoraFin'=>'required|unique:jornadas,HoraFin,'.$id.',IdJornada,EstadoJornada,'.true,
            'EstadoJornada'=>'required|int',    
        ]);
               
        $jornada = Jornada::findOrFail($id);
        $jornada->NombreJornada = $request['NombreJornada'];
        $jornada->HoraInicio = $request['HoraInicio'];
        $jornada->HoraFin = $request['HoraFin'];
        $jornada->save();

        return redirect()->route('jornada.index')->with('success','La jornada se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax()) {
            $jornada = Jornada::findOrfail($id);
           if ($jornada != null) {
                if ($jornada->EstadoJornada == true) {
                    $jornada->EstadoJornada = false;
                    $jornada->save();
                }else {
                    $jornada->EstadoJornada = true;
                    $jornada->save();
                }
           }else {
            $jornada->EstadoJornada = false;
            $jornada->save();
           }
           return response()->json([
            'message' => 'La jornada '. $jornada->NombreJornada.' Ha sido eliminada exitosamente!'
        ]);
        }
    }
}
