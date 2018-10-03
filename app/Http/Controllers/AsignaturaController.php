<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignatura;
use App\Salon;
use App\Maestro;
use App\Materia;
use App\TipoAsignatura;
use App\Logro;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignaturas = Asignatura::join('materias', 'asignaturas.IdMateria', '=', 'materias.IdMateria')                                    
                                    ->join('tipoasignaturas', 'asignaturas.IdTipoAsignatura', '=', 'tipoasignaturas.IdTipoAsignatura')
                                    ->where('EstadoAsignatura', true)
                                    ->select('asignaturas.*','materias.NombreMateria',
                                            'tipoasignaturas.NombreTipoAsignatura')
                                    ->getQuery()
                                    ->get();        
        $materias = Materia::where('EstadoMateria', true)->get();        
        $tipoasignaturas = TipoAsignatura::where('EstadoTipoAsignatura', true)->get();                                    
        return view('asignaturas.index', compact('asignaturas','materias','tipoasignaturas'));
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
        
        if ($request['IdAsignatura'] != 0) {
            $this->update($request, $request['IdAsignatura']);
            return redirect()->route('asignatura.index')->with('success','La asignatura se actualizo con exito');
        } else {                        
                
            $materias = request()->validate([                
                'NombreAsignatura'=>'required|unique:asignaturas,NombreAsignatura',
                'IdMateria'=>'required|int',                                         
                'IdTipoAsignatura'=>'required|int',           
                'EstadoAsignatura'=>'required|int',
                'Intensidad'=>'required|int'           
            ]);

            Asignatura::create($request->all());
            return redirect()->route('asignatura.index')->with('success','La asignatura se registro con exito');    
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
        $logros = Logro::where('EstadoLogro', true)->where('IdAsignatura', $id)->get();
        return response()->json($logros);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asignatura = Asignatura::findOrFail($id);                
        return response()->json($asignatura);
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
        $materias = request()->validate([                
            'NombreAsignatura'=>'required|unique:asignaturas,NombreAsignatura,'.$id.',IdAsignatura',
            'IdMateria'=>'required|int',                                         
            'IdTipoAsignatura'=>'required|int',           
            'EstadoAsignatura'=>'required|int',
            'Intensidad'=>'required|int'           
        ]);

        $asignatura = Asignatura::findOrFail($id);
        $asignatura->IdMateria = $request['IdMateria'];                
        $asignatura->NombreAsignatura = $request['NombreAsignatura'];
        $asignatura->DescripcionAsignatura = $request['DescripcionAsignatura'];
        $asignatura->IdTipoAsignatura = $request['IdTipoAsignatura'];
        $asignatura->Intensidad = $request['Intensidad'];
        $asignatura->save();

        return redirect()->route('asignatura.index')->with('success','La asignatura se registro con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asignatura = Asignatura::findOrfail($id);
       if ($asignatura != null) {
            if ($asignatura->EstadoAsignatura== true) {
                $asignatura->EstadoAsignatura = false;
                $asignatura->save();
            }else {
                $asignatura->EstadoAsignatura = true;
                $asignatura->save();
            }
       }else {
        $asignatura->EstadoAsignatura = false;
        $asignatura->save();
       }
        return redirect()->route('asignatura.index')->with('success','La asignatura fue eliminada con exito ');
    }
}
