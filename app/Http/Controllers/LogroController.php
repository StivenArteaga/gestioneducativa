<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logro;
use App\Periodo;
use App\Materia;
use App\Asignatura;

class LogroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logros = Logro::join('periodos', 'logros.IdPeriodo', '=', 'periodos.IdPeriodo')
                        ->join('asignaturas', 'logros.IdAsignatura', '=', 'asignaturas.IdAsignatura')
                        ->where('EstadoLogro', true)
                        ->select('logros.*', 'periodos.NumeroPeriodo', 'asignaturas.NombreAsignatura')
                        ->getQuery()
                        ->get();

        $periodos = Periodo::where('EstadoPeriodos', true)->get();
        $asignaturas = Asignatura::where('EstadoAsignatura', true)->get();
        return view('logro.index', compact('logros','periodos', 'asignaturas'));                        
    }

    /**
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
        if ($request['IdLogro'] != 0) {
            $this->update($request, $request['IdLogro']);            
            return redirect()->route('logro.index')->with('success','El logro se actualizo con exito');
        } else {            
            
            $logros = request()->validate([
                'DescripcionLogro'=>'required|regex:/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+$/|max:200',               
                'IdAsignatura'=>'required|int',
                'IdPeriodo'=>'required|int',    
                'EstadoLogro'=>'required|int'           
            ]);
            
            $exis = Logro::where('IdAsignatura', '=', $request['IdAsignatura'])
                        ->where('IdPeriodo', '=', $request['IdPeriodo'])
                        ->where('EstadoLogro', true)
                        ->get()
                        ->toArray(); 
                                     
            if ($exis != null) {
                return redirect()->route('logro.index')->with('errors','Ya existe un logro con esta asignatura y este periodo');    
            } else {
                Logro::create($request->all());
                return redirect()->route('logro.index')->with('success','El logro se registro con exito');    
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
        $logros =  Logro::findOrFail($id);
        return response()->json($logros);
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
            'DescripcionLogro'=>'required|regex:/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/|max:200',               
            'IdAsignatura'=>'required',
            'IdPeriodo'=>'required',
            'EstadoLogro'=>'required|int'           
        ]);
        
        $exis = Logro::where('IdAsignatura', '=', $request['IdAsignatura'])
        ->where('IdPeriodo', '=', $request['IdPeriodo'])
        ->where('EstadoLogro', true)
        ->get()
        ->toArray(); 
        
        $val;
        foreach ($exis as $key => $value) {
            if ($value['IdAsignatura'] == $request['IdAsignatura'] && 
                $value['IdPeriodo'] == $request['IdPeriodo'] && 
                $value['IdLogro'] == $request['IdLogro']) {
                   $val = true;                
            } else {
                $val = false;  
            }
            
        }
        
        if ($exis == null) {
            $logro = Logro::findOrFail($id);
            $logro->DescripcionLogro = $request['DescripcionLogro'];
            $logro->IdAsignatura = $request['IdAsignatura'];
            $logro->IdPeriodo = $request['IdPeriodo'];
            $logro->save();
    
            return redirect()->route('logro.index')->with('success','El logro  se actualizo con exito');

        } else {
            if ($val == true) {
                $logro = Logro::findOrFail($id);
                $logro->DescripcionLogro = $request['DescripcionLogro'];
                $logro->IdAsignatura = $request['IdAsignatura'];
                $logro->IdPeriodo = $request['IdPeriodo'];
                $logro->save();
        
                return redirect()->route('logro.index')->with('success','El logro  se actualizo con exito');
                
            } else {
                return redirect()->route('logro.index')->with('errors','Ya existe un logro con esta asignatura y este periodo');    
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
       $logro = Logro::findOrfail($id);
       if ($logro != null) {
            if ($logro->EstadoLogro == true) {
                $logro->EstadoLogro = false;
                $logro->save();
            }else {
                $logro->EstadoLogro = true;
                $logro->save();
            }
       }else {
        $logro->EstadoLogro = false;
        $logro->save();
       }
        return redirect()->route('logro.index')->with('success','El logro fue eliminado con exito ');
    }
}
