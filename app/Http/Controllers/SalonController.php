<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salon;
use App\Sede;
use App\Jornada;
use App\Maestro;
use App\Grado;

class SalonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $aulas = Salon::join('sedes', 'salones.IdSede', '=', 'sedes.IdSede')
                      ->where('EstadoSalon', true)
                      ->select('salones.*','sedes.NombreSede')
                      
                      ->getQuery()
                      ->get();
                      
        $sedes = Sede::where('EstadoSede', true)->get();

        return view('salon.index', compact('aulas', 'sedes'));
                        
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
        $logros = request()->validate([
            'NombreSalon'=>'required|regex:/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/|max:50',
            'IdSede'=>'required|int',                   
            'EstadoSalon'=>'required|int'           
        ]);
        
        if ($request['IdSalon'] != 0) {
            $this->update($request, $request['IdSalon']);
            return redirect()->route('aula.index')->with('success','El aula se actualizo con exito');
        } else {                                    

            Salon::create($request->all());
            return redirect()->route('aula.index')->with('success','El aula se registro con exito');    
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
        $aulas = Salon::findOrFail($id);
        return response()->json($aulas);
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
        $aula = Salon::findOrFail($id);
        $aula->NombreSalon = $request['NombreSalon'];
        $aula->IdSede = $request['IdSede'];
        $aula->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aula = Salon::findOrfail($id);
       if ($aula != null) {
            if ($aula->EstadoSalon == true) {
                $aula->EstadoSalon = false;
                $aula->save();
            }else {
                $aula->EstadoSalon = true;
                $aula->save();
            }
       }else {
        $aula->EstadoSalon = false;
        $aula->save();
       }
        return redirect()->route('aula.index')->with('success','El aula fue eliminada con exito ');
    }
}
