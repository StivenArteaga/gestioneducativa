<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maestro;
use App\Ciudad;
use App\TipoSangre;
use App\TipoDocumento; 
use App\Genero;
use App\Asignatura;

class MaestroController extends Controller
{
    public function index()
    { 
        $maestro = Maestro::join('tipodocumentos', 'maestros.IdTipoDocumento', '=', 'tipodocumentos.IdTipoDocumento')
                            ->join('generos', 'maestros.IdGenero', '=', 'generos.IdGenero')
                            ->join('tiposangres', 'maestros.IdTipoSangre', '=', 'tiposangres.IdTipoSangre')
                            ->join('ciudades', 'maestros.IdCiudad', '=', 'ciudades.IdCiudad')
                            ->join('asignaturas', 'maestros.IdAsignatura', '=', 'asignaturas.IdAsignatura')
                            ->where('EstadoMaestro', true)
                            ->select('maestros.*', 'tipodocumentos.NombreTipoDocumento', 'generos.NombreGenero', 
                                    'NombreTipoSangre', 'ciudades.NombreCiudad', 'asignaturas.NombreAsignatura')
                            ->getQuery()
                            ->get();        

        $tipodocumentos = TipoDocumento::where('EstadoTipoDocumento', true)->get();
        $generos = Genero::all();                            
        $sangres = TipoSangre::all();
        $ciudades = Ciudad::where('EstadoCiudades', true)->get();
        $asignaturas= Asignatura::where('EstadoAsignatura', true)->get();
        return view('maestro.index', compact('maestro','tipodocumentos', 'generos', 'sangres', 'ciudades',
                                             'asignaturas'));
    }

    public function create()
    {        
        $ciudades = Ciudad::all();
        $sangres = TipoSangre::all();
        $tipodocumentos = TipoDocumento::all();
        $generos = Genero::all();
        return view('maestro.create', compact('ciudades', 'sangres', 'tipodocumentos', 'generos'));   
    }

    public function store(Request $request)
    {        
        if ($request['IdMaestro'] != 0) {
            $this->update($request, $request['IdMaestro']);
            return redirect()->route('maestro.index')->with('success','La actualización del docente se realizo con exito');
        } else {

            request()->validate([
                'IdAsignatura'=>'required|int',
                'PrimerNombreMaes'=> ['required', 'string'],             
                'PrimerApellidoMaes'=>['required', 'string'],
                'SegundoApellidoMaes'=>['required', 'string'], 
                'IdTipoDocumento'=>'required|int',            
                'NumeroDocumento'=>'required|string|unique:maestros,NumeroDocumento|max:12',
                'FechaNacimiento'=>'required|date',
                'IdGenero'=>'required|int',
                'IdTipoSangre'=>'required|int',                
                'Correo'=>'required|email|unique:maestros,Correo',
                'Direccion'=>'required',
                'Telefono'=>'required',
                'IdCiudad'=>'required|int',
                'Especializacion'=>'required',
                'Escalafon'=>'required',
                'Coordinador'=>'required',
                'EstadoMaestro'=>'required|int'
            ]); 
                   
            
            Maestro::create($request->all());
            return redirect()->route('maestro.index')->with('success','El registro del docente se realizo con exito');
        }        
    }

    public function show($id)
    { 
        $maestro = Maestro::find($id);
        $ciudades = Ciudad::all();
        $sangres = TipoSangre::all();
        $tipodocumentos = TipoDocumento::all();
        $generos = Genero::all();
        return view('maestro.show', compact('maestro','ciudades', 'sangres', 'tipodocumentos', 'generos'));
    }

    public function edit($id)
    {        
        $maestros = Maestro::find($id);                
        return response()->json($maestros);

    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'IdAsignatura'=>'required|int',
            'PrimerNombreMaes'=> 'string|required',             
            'PrimerApellidoMaes'=>'string|required',
            'SegundoApellidoMaes'=>'string|required', 
            'IdTipoDocumento'=>'int|required',
            'NumeroDocumento'=>'required','string','unique:maestros,NumeroDocumento','max:12,'.$id.',IdMaestro',
            'FechaNacimiento'=>'string|required',
            'IdGenero'=>'int|required',
            'IdTipoSangre'=>'int|required',
            'Correo'=>'required','email','unique:maestros,Correo,'.$id.',IdMaestro',
            'Direccion'=>'string|required',
            'Telefono'=>'string|required',
            'IdCiudad'=>'int|required',
            'Especializacion'=>'string|required',
            'Escalafon'=>'string|required',
            'Coordinador'=>'string|required',
        ]);        
        
        Maestro::find($id)->update($request->all());
        return redirect()->route('maestro.index')->with('success','El registro del maestro se actualizo con exito');
    }

    public function destroy($id)
    {
        $maestro = Maestro::findOrfail($id);
        if ($maestro != null) {
             if ($maestro->EstadoMaestro == true) {
                 $maestro->EstadoMaestro = false;
                 $maestro->save();
             }else {
                 $maestro->EstadoMaestro = true;
                 $maestro->save();
             }
        }else {
         $maestro->EstadoMaestro = false;
         $maestro->save();
        }
         return redirect()->route('maestro.index')->with('success','El maestro fue eliminado con exito ');
    }

}
