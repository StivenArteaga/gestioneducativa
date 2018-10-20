<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use App\Area;
use App\Asignatura;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Materia::join('areas', 'materias.IdArea', '=', 'areas.IdArea')    
                ->where('EstadoMateria', true)
                ->select('materias.*', 'areas.NombreArea')
                ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
                ->get();
            
        $areas = Area::where('EstadoArea','=', true)->get();
        $materias = Materia::where('EstadoMateria', true)->get();
        return view('materia.index', compact('result','materias','areas'));
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
        if ($request['IdMateria'] != 0) {
            $this->update($request, $request['IdMateria']);
            return redirect()->route('materias.index')->with('success','La materia se actualizo con exito');
        } else {  
            
            $materias = request()->validate([
                'NombreMateria'=>'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',
                'IdArea'=>'required|int',                
                'EstadoMateria'=>'required|int'           
            ]);

            $existesede = Materia::where('NombreMateria', '=', $request['NombreMateria'])
            ->where('EstadoMateria', '=', true)
            ->first();

            if($existesede != null){
                return redirect()->route('materias.index')->with('errors','Esta materia ya se encuentra registrada');                                                                 
            }else{
                Materia::create($request->all());
                return redirect()->route('materias.index')->with('success','La materia se registro con exito');    
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
        $asignaturas = Asignatura::where('IdMateria', $id)->where('EstadoAsignatura', true)->get();                
        return response()->json($asignaturas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $materia = Materia::findOrFail($id);        
        return response()->json($materia);
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
            'NombreMateria'=>'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/|unique:materias,NombreMateria,'.$id.',IdMateria,EstadoMateria,'.true,
            'IdArea'=>'required|int',                
            'EstadoMateria'=>'required|int'           
        ]);

        $materia = Materia::findOrFail($id);
        $materia->NombreMateria = $request['NombreMateria'];
        $materia->IdArea = $request['IdArea'];
        $materia->DescripcionMateria = $request['DescripcionMateria'];
        $materia->save();

        return redirect()->route('materias.index')->with('success','La materia se registro con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $materia = Materia::findOrfail($id);
       if ($materia != null) {
            if ($materia->EstadoMateria == true) {
                $materia->EstadoMateria = false;
                $materia->save();
            }else {
                $materia->EstadoMateria = true;
                $materia->save();
            }
       }else {
        $materia->EstadoMateria = false;
        $materia->save();
       }
        return redirect()->route('materias.index')->with('success','La materia fue eliminada con exito ');
    }
}
