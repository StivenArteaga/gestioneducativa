<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetalleTipoGrupoAsignatura;
use App\Asignatura;
use App\Grupo;
use App\TipoGrupo;
use Exception;

class TipoGrupoController extends Controller
{

    public function index()
    {
        $tipogrupos = TipoGrupo::where('EstadoTipoGrupo','=', true )                               
                               ->select('tipogrupos.*')
                               ->get();

        $asignaturas = Asignatura::where('EstadoAsignatura', '=', true)->get();

        return view('tipogrupo.index', compact('tipogrupos', 'asignaturas'));                               
    }

    
    public function store(Request $request)
    {                
            if($request['IdAsignatura'] != null){
                if($request['IdTipoGrupo'] != null){
                    $this->update($request, $request['IdTipoGrupo']);            
                    return redirect()->route('tgrupo.index')->with('success','El tipo de grupo se actualizo con exito');
                }else{
                                        
                    $tipogrupo = request()->validate([                    
                        'NombreTipoGrupo'=>'required|min:5|max:50|regex:/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+$/',
                        'EstadoTipoGrupo'=>'required|int'                      
                    ]);
                    
                    $existe = TipoGrupo::where('NombreTipoGrupo', '=', $request['NombreTipoGrupo'])
                                        ->where('EstadoTipoGrupo', '=', true)
                                        ->first();
                    
                    if($existe != null){
                        return redirect()->route('tgrupo.index')->with('error','Este nombre de tipo de grupo ya se encuentra registrado');
                    }else{
    
                        $valtipogrupo = ([
                            'NombreTipoGrupo',
                            'EstadoTipoGrupo'
                        ]);
                        
                        $valtipogrupo['NombreTipoGrupo'] = $request['NombreTipoGrupo'];
                        $valtipogrupo['EstadoTipoGrupo'] = $request['EstadoTipoGrupo'];
                        TipoGrupo::create($valtipogrupo);                        

                        $dttipogrupos =  TipoGrupo::all();
                        $iddttipogrupos =  $dttipogrupos->last();

                        foreach ($request['IdAsignatura'] as $key => $value) {
                            $detalle = ([
                                'IdTipoGrupoDetalleTipoGrupoAsignatura',
                                'IdAsignaturaDetalleTipoGrupoAsignatura'
                            ]);

                            $detalle['IdTipoGrupoDetalleTipoGrupoAsignatura'] = $iddttipogrupos['IdTipoGrupo'];
                            $detalle['IdAsignaturaDetalleTipoGrupoAsignatura']= $value;
                            DetalleTipoGrupoAsignatura::create($detalle);
                        }
    
                        return redirect()->route('tgrupo.index')->with('success','El tipo de grupo se registro con exito');
                    }   
                }        
            }else{
                return redirect()->route('tgrupo.index')->with('error','Al tipo de grupo no le has asignado asignaturas. El tipo de grupo necesita como minimo una asignatura');
            }                       
    }


    public function updtipgrup($id)
    {
        $tipogrupo = TipoGrupo::findOrFail($id);
        $asignaturas = DetalleTipoGrupoAsignatura::where('IdTipoGrupoDetalleTipoGrupoAsignatura', '=', $id) 
                                                ->select('detalletipogrupoasignaturas.*')
                                                ->get();

        return response()->json(['tipogrupo'=>$tipogrupo, 'asignaturas'=>$asignaturas]);                                                
    }

    public function update(Request $request, $id)
    {
        try{
        
            request()->validate([
                'NombreTipoGrupo'=>'required|min:5|max:50|regex:/^[a-zA-Z]+(\s*[a-zA-Z]*)*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+$/|unique:tipogrupos,NombreTipoGrupo,'.$id.',IdTipoGrupo,EstadoTipoGrupo,'.true,
                'EstadoTipoGrupo'=>'required|int'                      
            ]); 
            
            $tipogrupo = TipoGrupo::findOrFail($id);
            $tipogrupo->NombreTipoGrupo = $request['NombreTipoGrupo'];
            $tipogrupo->save();
            
            $deleteasignaturas = DetalleTipoGrupoAsignatura::where('IdTipoGrupoDetalleTipoGrupoAsignatura', '=', $id)->get()->toArray(); 
            foreach ($deleteasignaturas as $key => $value) {
                $eliminar = DetalleTipoGrupoAsignatura::where('IdTipoGrupoDetalleTipoGrupoAsignatura','=',$value['IdTipoGrupoDetalleTipoGrupoAsignatura'] )->firstOrFail();
                $eliminar->delete();
            }

            
            foreach ($request['IdAsignatura'] as $key => $value) {
                $existe= DetalleTipoGrupoAsignatura::where('IdTipoGrupoDetalleTipoGrupoAsignatura', '=', $id)
                                                    ->where('IdAsignaturaDetalleTipoGrupoAsignatura', '=', $value)
                                                    ->first();

                if($existe == null){
                    $valores = ([
                        'IdTipoGrupoDetalleTipoGrupoAsignatura',
                        'IdAsignaturaDetalleTipoGrupoAsignatura'
                    ]);
    
                    $valores['IdTipoGrupoDetalleTipoGrupoAsignatura'] = $id;
                    $valores['IdAsignaturaDetalleTipoGrupoAsignatura'] = $value;
                    DetalleTipoGrupoAsignatura::create($valores);
                }
            }

            return redirect()->route('tgrupo.index')->with('success','La actualización del tipo de grupo fue exitosa!');    
        }
        catch(\Exception $e){
            return redirect()->route('tgrupo.index')->with('error','Algo ha salido mal con tu actualización, recarga la pagina y vuelve a intentarlo!');
        }
    }

    
    public function destroy($id)
    {
        if($request->ajax()) {
            $tipogrupo = TipoGrupo::findOrfail($id);
            if ($tipogrupo != null) {
                 if ($tipogrupo->EstadoTipoGrupo == true) {
                     $tipogrupo->EstadoTipoGrupo = false;
                     $tipogrupo->save();
                 }else {
                     $tipogrupo->EstadoTtipogrupoipoGrupo = true;
                     $tipogrupo->save();
                 }
            }else {
             $tipogrupo->EstadoTipoGrupo = false;
             $tipogrupo->save();
            }
            return response()->json([
                'message' => 'El Tipo de grupo '.$tipogrupo ->NombreTipoGrupo.' ha sido eliminada exitosamente!'
            ]);
        }
    }
}
