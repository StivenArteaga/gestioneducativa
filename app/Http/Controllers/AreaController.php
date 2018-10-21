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
                'NombreArea'=>'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',
                'EstadoArea'=>'required|int'
            ]);            
    
            $existesede = Area::where('NombreArea', '=', $request['NombreArea'])
                                ->where('EstadoArea', '=', true)
                                ->first();

            if($existesede != null){
                return redirect()->route('area.index')->with('errors','El nombre de esta area ya se encuentra registrada');                                                                 
            }else{
                Area::create($request->all());
                return redirect()->route('area.index')->with('success','El area se registro con exito');    
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
            'NombreArea'=>'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/|unique:areas,NombreArea,'.$id.',IdArea,EstadoArea,'.true,
            'EstadoArea'=>'required|int'
        ]);   

        $area = Area::findOrFail($id);
        $area->NombreArea = $request['NombreArea'];
        $area->DescripcionArea = $request['DescripcionArea'];
        $area->save();

        return redirect()->route('area.index')->with('success','El area se actualizo con exito');
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
        return redirect()->route('area.index')->with('success','El area fue eliminada con exito ');
    }
}
