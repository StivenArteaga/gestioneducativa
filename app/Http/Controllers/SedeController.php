<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sede;
use App\Institucion;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = Sede::where('EstadoSede', true)->get();
        $instituciones = Institucion::where('EstadoInstitucion', true)->get();

        return view('sede.index', compact('sedes', 'instituciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['IdSede'] != 0) {
            $this->update($request, $request['IdSede']);            
            return redirect()->route('sede.index')->with('success','La sede se actualizo con exito');
        } else {                        
            $input = $request->only(['NombreSede', 'IdInstitucion', 'EstadoSede']);
            $sede = request()->validate([
                'NombreSede'=>'required|unique:sedes,NombreSede|regex:/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/|max:50',               
                'IdInstitucion'=>'required|int',                
                'EstadoSede'=>'required|int',                
            ]);
            $request->flash();
            Sede::create($request->all());
            return redirect()->route('sede.index')->with('success','La sede ha sido creada correctamente');                                                                 
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
        $sedes = Sede::findOrFail($id);        
        return response()->json($sedes);
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
            'NombreSede'=>'required|regex:/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/|max:50|unique:sedes,NombreSede,'.$id.',IdSede',
            'IdInstitucion'=>'required|int',                
            'EstadoSede'=>'required|int',                
        ]);

        $sede = Sede::find($id);
        $sede->NombreSede  = $request['NombreSede'];        
        $sede->save();
        return redirect()->route('sede.index')->with('success','La sede se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sedes = Sede::findOrfail($id);
       if ($sedes != null) {
            if ($sedes->EstadoSede == true) {
                $sedes->EstadoSede = false;
                $sedes->save();
            }else {
                $sedes->EstadoSede = true;
                $sedes->save();
            }
       }else {
        $sedes->EstadoSede = false;
        $sedes->save();
       }
        return redirect()->route('sede.index')->with('success','La sede fue eliminada con exito ');
    }
}
