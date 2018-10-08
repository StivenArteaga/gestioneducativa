<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grado;
use App\Asignatura;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grados = Grado::where('EstadoGrado', true)->get();
        $asignaturas = [];
        return view('evaluacion.index', compact('grados','asignaturas'));
    }


    public function listasig($id)
    {
        $asignaturas = Asignatura::join('detallegruposasignaturas', 'asignaturas.IdAsignatura', '=', 'detallegruposasignaturas.IdAsignatura')
                                 ->join('grupos', 'detallegruposasignaturas.IdGrupo', '=', 'grupos.IdGrupo')                                 
                                 ->where('EstadoAsignatura', true)
                                 ->where('grupos.IdGrado', '=', $id)
                                 ->where('EstadoGrupo', true)
                                 ->select('asignaturas.*','grupos.IdGrupo')
                                 ->getQuery()
                                 ->distinct()
                                 ->get(['grupos.IdGrupo']);
        
        return response()->json($asignaturas);
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
