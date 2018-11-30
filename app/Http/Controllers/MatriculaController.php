<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matricula;
use App\Grado;
use App\Alumno;
use App\Academica;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grados = Grado::where('EstadoGrado', true)->get();
        $alumnos = Alumno::where('EstadoAlumno', true)->get();
        $alumnosmatriculados = Matricula::join('alumnos', 'matriculas.IdAlumno', '=', 'alumnos.IdAlumno')
                                ->join('informacionesacademicas', 'alumnos.IdAlumno', '=', 'informacionesacademicas.IdAlumno')
                                ->join('grados', 'matriculas.IdGrado', '=', 'grados.IdGrado')
                                ->where('alumnos.EstadoAlumno', true)
                                ->where('matriculas.IdEstadoMatricula', '=', 2)
                                ->select('matriculas.*', 'informacionesacademicas.valorMatricula', 'grados.NombreGrado','alumnos.*')
                                ->getQuery()
                                ->get();
                        
        $alumnossinmatricular = Alumno::join('matriculas', 'alumnos.IdAlumno', '=', 'matriculas.IdAlumno')
                                    ->join('informacionesacademicas', 'alumnos.IdAlumno', '=', 'informacionesacademicas.IdAlumno')
                                    ->join('grados', 'matriculas.IdGrado', '=', 'grados.IdGrado')
                                    ->where('alumnos.EstadoAlumno', true)
                                    ->where('matriculas.IdEstadoMatricula', '=', 1)
                                    ->select('matriculas.IdMatricula', 'informacionesacademicas.valorMatricula', 'grados.NombreGrado','alumnos.*')
                                    ->getQuery()
                                    ->distinct()
                                    ->get(['alumnos.NumeroDocumento']);
            
        return view('matricula.index', compact('alumnosmatriculados', 'grados', 'alumnossinmatricular', 'alumnos'));
    }



    public function listmat($id)
    {

        $dat = Matricula::join('alumnos', 'matriculas.IdAlumno', '=', 'alumnos.IdAlumno')
                        ->join('informacionesacademicas', 'alumnos.IdAlumno', '=', 'informacionesacademicas.IdAlumno')
                        ->where('matriculas.IdAlumno', '=', $id)
                        ->select('matriculas.*', 'informacionesacademicas.valorMatricula')
                        ->getQuery()
                        ->get();
        
        return response()->json($dat);                       
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
        $matricula = request()->validate([
            'IdGradoName'=>'required',
            'valorMatricula'=>'required|regex:/^[$-,-.0-9]+$/'                      
        ]);
        
        $matri = Matricula::find($request['IdMatricula']);
        $matri->IdGrado = $request['IdGradoName'];
        $matri->valorMatricula = $request['valorMatricula'];
        $matri->IdEstadoMatricula = 2;        
        $matri->save();
        
        $academica = Academica::where('IdAlumno', '=', $matri['IdAlumno'])->firstOrFail();
        $academica->IdGrado = $request['IdGradoName'];        
        $academica->valorMatricula = $request['valorMatricula'];      
        $academica->save(); 

        return redirect()->route('matricula.index')->with('success','La matricula del alumno se actualizo con exito');
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
        if ($request->ajax()) {
            $matricula = Matricula::findOrFail($id);
            if ($matricula != null) {
                if ($matricula->IdEstadoMatricula == 2) {
                    $matricula->IdEstadoMatricula = 1;
                    $matricula->save();
                }else {
                    $matricula->IdEstadoMatricula = 1;
                    $matricula->save();
                }
            }else {
                $matricula->IdEstadoMatricula = 1;
                $matricula->save();
            }
            
            return response()->json([
                'message' => 'La matricula ha sido eliminada exitosamente!'
            ]);
        }
    }
}
