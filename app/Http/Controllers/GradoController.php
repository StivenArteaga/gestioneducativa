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
                'NombreGrado'=>'required|regex:/^[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z]*)*[0-9-a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',               
                'EstadoGrado'=>'required|int'           
            ]);
            
            $existe = Grado::where('NombreGrado', '=', $request['NombreGrado'])
            ->where('EstadoGrado', '=', true)
            ->first();

            if($existe != null){
                return redirect()->route('grado.index')->with('error','Este grado ya se encuentra registrado');                                                                 
            }else{
                Grado::create($request->all());
                return redirect()->route('grado.index')->with('success','El grado se registro con exito');     
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
            'NombreGrado'=>'required|regex:/^[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z]*)*[0-9-a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/|unique:grados,NombreGrado,'.$id.',IdGrado,EstadoGrado,'.true,
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
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
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
            
            return response()->json([
                'message' => 'El grado '. $grado->NombreGrado.' Ha sido eliminado exitosamente!'
            ]);
        }
    }
}
