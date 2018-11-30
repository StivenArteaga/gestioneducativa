<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calificacion;

class CalificacionController extends Controller
{    
    public function index()
    {
        $calificaciones = Calificacion::where('EstadoNota', '=', true)->select('notas.*')->get();

        return view('calificacion.index', compact('calificaciones'));
    }
    
    public function store(Request $request)
    {        
        if($request['IdNota'] != 0){
            $this->update($request, $request['IdNota']);
            return redirect()->route('calificacion.index')->with('success', 'La calificación se actualizo correctamente');
        }else{
            $calificacion = request()->validate([
                'NombreNota'=>'required|max:50|regex:/^[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+$/',
                'EstadoNota'=>'int'
            ]);

            $existe = Calificacion::where('NombreNota', '=', $request['NombreNota'])
                                  ->where('EstadoNota','=', true)
                                  ->first();
            
            if($existe != null){
                return redirect()->route('calificacion.index')->with('error','Esta calificación ya se encuentra registrada en el sistema');
            }else{
                Calificacion::create($request->all());
                return redirect()->route('calificacion.index')->with('success', 'La calificación se registro correctamente');
            }
        }
    }

        
    public function edit($id)
    {
        if($id == null){
            return response()->json(['status'=>'warning','message' => 'Los datos de este registro no se consutaron correctamente. Actualice su navegador y vuelva a intertar consultar este registro']);                                 
        }else{
            $calificacion = Calificacion::where('IdNota', '=', $id)->select('notas.*')->first();
            if($calificacion == null){
                return response()->json(['status'=>'warning','message' => 'Los datos de este registro no se consutaron correctamente. Actualice su navegador y vuelva a intertar consultar este registro']);                                 
            }else{
                return response()->json(['status'=>'success','calificacion'=> $calificacion]);
            }
        }
    }

    
    public function update(Request $request, $id)
    {
        $calificacion = request()->validate([
            'NombreNota'=>'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+$/|unique:notas,NombreNota,'.$id.',IdNota,EstadoNota,'.true,
            'EstadoNota'=>'required|int'
        ]);
        
        $update = Calificacion::findOrFail($id);
        $update->NombreNota = $request['NombreNota'];        
        $update->save();

        return redirect()->route('calificacion.index')->with('success','La calificación se actualizo con exito');
    }

    
    public function destroy($id)
    {
        if ($request->ajax()) {
            $calificacion = Calificacion::findOrFail($id);
            if ($calificacion != null) {
                if ($calificacion->EstadoNota == true) {
                    $calificacion->EstadoNota = false;
                    $calificacion->save();
                }else {
                    $calificacion->EstadoNota = true;
                    $calificacion->save();
                }
            }else {
                $calificacion->EstadoNota = false;
                $calificacion->save();
            }
            
            return response()->json([
                'message' => 'La calificación '. $calificacion->NombreNota.' Ha sido eliminada exitosamente!'
            ]);
        }
    }
}
