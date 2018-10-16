<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grado;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grados = Grado::where('EstadoGrado', true)->get();
        return view('grado.index', compact('grados'));
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
        
        if ($request['IdGrado'] != 0) {
            $this->update($request, $request['IdGrado']);
            return redirect()->route('grado.index')->with('success','El grado se actualizo con exito');
        } else {                        

            $grados = request()->validate([
                'NombreGrado'=>'required|unique:grados,NombreGrado|regex:/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/',               
                'EstadoGrado'=>'required|int'           
            ]);
            
            Grado::create($request->all());
            return redirect()->route('grado.index')->with('success','El grado se registro con exito');  
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
        $grados = Grado::findOrFail($id);
        return response()->json($grados);
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
        $grados = request()->validate([
            'NombreGrado'=>'required|regex:/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z]+$/|unique:grados,NombreGrado,'.$id.',IdGrado',
            'EstadoGrado'=>'required|int'           
        ]);

        $grado = Grado::findOrFail($id);
        $grado->NombreGrado = $request['NombreGrado'];
        $grado->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grado = Grado::findOrFail($id);
       if ($grado != null) {
            if ($grado->EstadoGrado == true) {
                $grado->EstadoGrado = false;
                $grado->save();
            }else {
                $grado->EstadoGrado = true;
                $grado->save();
            }
       }else {
        $grado->EstadoGrado = false;
        $grado->save();
       }
        return redirect()->route('grado.index')->with('success','El grado fue eliminado con exito ');
    }
}
