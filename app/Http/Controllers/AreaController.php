<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Materia;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::where('EstadoArea', true)->get();
        $materias = [];
        return view('area.index', compact('areas','materias'));
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
        if ($request['IdArea'] != 0) {
            $this->update($request, $request['IdArea']);
            return redirect()->route('area.index')->with('success','El area se registro con exito');
        } else {

            $areas = request()->validate([
                'NombreArea'=>'required|unique:areas,NombreArea|max:50|regex:/^[A-Za-z]*\s()[A-Za-z]*$/u',
                'EstadoArea'=>'required|int'
            ]);            
    
            Area::create($request->all());
            return redirect()->route('area.index')->with('success','El area se registro con exito');    
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
        $materias = Materia::where('IdArea',$id)->where('EstadoMateria', true)->get();        
        return response()->json($materias);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {           
        $area = Area::findOrFail($id);        
        return response()->json($area);
        
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
        $areas = request()->validate([
            'NombreArea'=>'required|regex:/^[A-Za-z]*\s()[A-Za-z]*$/u|unique:areas,NombreArea,'.$id.',IdArea',
            'EstadoArea'=>'required|int'
        ]);   

        $area = Area::findOrFail($id);
        $area->NombreArea = $request['NombreArea'];
        $area->DescripcionArea = $request['DescripcionArea'];
        $area->save();

        return redirect()->route('area.index')->with('success','El area se registro con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $area = Area::findOrfail($id);
       if ($area != null) {
            if ($area->EstadoArea == true) {
                $area->EstadoArea = false;
                $area->save();
            }else {
                $area->EstadoArea = true;
                $area->save();
            }
       }else {
        $area->EstadoArea = false;
        $area->save();
       }
        return redirect()->route('area.index')->with('success','El area fue elimino con exito ');
    }
}
