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
        if ($request['IdSalon'] != 0) {
            $this->update($request, $request['IdSalon']);
            return redirect()->route('aula.index')->with('success','El aula se actualizo con exito');
        } else {                                    

            $logros = request()->validate([
                'NombreSalon'=>'required|regex:/^[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z]*)*[0-9-a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/|max:50',
                'IdSede'=>'required|int',                   
                'EstadoSalon'=>'required|int'           
            ]);

            $existe = Salon::where('NombreSalon', '=', $request['NombreSalon'])
                      ->where('IdSede', '=', $request['IdSede'])
                      ->where('EstadoSalon','=', true)
                      ->first();
            
            if($existe != null){
                return redirect()->route('aula.index')->with('error','Esta aula ya se encuentra registrada en esta sede');    
            }else{
                Salon::create($request->all());
                return redirect()->route('aula.index')->with('success','El aula se registro con exito');    
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
        $logros = request()->validate([
            'NombreSalon'=>'required|regex:/^[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z]*)*[0-9-a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/|max:50',
            'IdSede'=>'required|int',                   
            'EstadoSalon'=>'required|int'           
        ]);
        
        $existe = Salon::where('NombreSalon', '=', $request['NombreSalon'])
                      ->where('IdSede', '=', $request['IdSede'])
                      ->where('EstadoSalon','=', true)
                      ->first();
            
            if($existe != null){
                return redirect()->route('aula.index')->with('error','Esta aula ya se encuentra registrada en la sede que le asigno');    
            }else{
                $aula = Salon::findOrFail($id);
                $aula->NombreSalon = $request['NombreSalon'];
                $aula->IdSede = $request['IdSede'];
                $aula->save();
            }
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
            $aula = Salon::findOrFail($id);
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
            
            return response()->json([
                'message' => 'El aula '.$aula->NombreSalon.' ha sido eliminada exitosamente!'
            ]);
        }
    }
}
