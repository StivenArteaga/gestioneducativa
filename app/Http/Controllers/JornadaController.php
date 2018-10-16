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
                'NombreJornada'=>'required|unique:jornadas,NombreJornada|regex:/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/',               
                'HoraInicio'=>'required',     
                'HoraFin'=>'required',     
                'EstadoJornada'=>'required|int',    
            ]);
                
            if ($request['HoraFin'] <= $request['HoraInicio']) {
                return redirect()->route('jornada.index')->with('errors','La hora fin no puede ser menor o igual a la hora de inicio en una jornada'.' '.'Hora de inicio: '.$request['HoraInicio'].'-'.'Hora fin: '.$request['HoraFin']);
            } else {
                $valHora = Jornada::where('EstadoJornada', true)->get();
                $cont;
                foreach ($valHora as $key => $value) {
        
                    if (($request['HoraInicio'] >= $value['HoraFin'])&& ($request['HoraFin'] <= $value['HoraInicio'])||
                        ($request['HoraInicio'] < $value['HoraFin'])&& ($request['HoraFin'] <= $value['HoraInicio'])||
                        ($request['HoraInicio'] >= $value['HoraFin'])&& ($request['HoraFin'] > $value['HoraInicio']) ) {
                        $cont = true;
                    } else {
                        $cont = false;               
                    }            
                }        
                if ($cont) {
                        
                    $request['HoraInicio'] = ((new Carbon($request['HoraInicio']))->format('H') == '00') ? (new Carbon($request['HoraInicio']))->format('h:i:s') : (new Carbon($request['HoraInicio']))->format('H:i:s') ;
                    $request['HoraInicio'] = (new Carbon($request['HoraInicio']))->toTimeString();
                    $request['HoraFin'] = (new Carbon($request['HoraFin']))->toTimeString();
                        
                    Jornada::create($request->all());
                    return redirect()->route('jornada.index')->with('success','La jornada se registro con exito');  
                } else {
                    return redirect()->route('jornada.index')->with('errors','Ya existe una jornada que contiene un rango de horas entre'.$request['HoraInicio'].'-'.$request['HoraFin']);
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
            'NombreJornada'=>'required|regex:/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/|unique:jornadas,NombreJornada,'.$id.',IdJornada',
            'HoraInicio'=>'required|unique:jornadas,HoraInicio,'.$id.',IdJornada',
            'HoraFin'=>'required|unique:jornadas,HoraFin,'.$id.',IdJornada',
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
    public function destroy($id)
    {
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
        return redirect()->route('jornada.index')->with('success','La jornada fue eliminada con exito ');
    }
}
