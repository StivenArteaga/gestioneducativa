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
                'PrimerNombreMaes'=> ['required', 'string', 'max:50', 'regex:/^[A-Za-z]*$/u'],             
                'PrimerApellidoMaes'=>['required', 'string', 'max:50', 'regex:/^[A-Za-z]*$/u'],             
                'SegundoApellidoMaes'=>['required', 'string', 'max:50', 'regex:/^[A-Za-z]*$/u'],             
                'IdTipoDocumento'=>'required|int',            
                'NumeroDocumento'=>'required|string|unique:maestros,NumeroDocumento|max:12|regex:/^[0-9]+$/',
                'FechaNacimiento'=>'required|date',
                'IdGenero'=>'required|int',
                'IdTipoSangre'=>'required|int',                
                'Correo'=>'required|email|unique:maestros,Correo|max:200',
                'Direccion'=>'required|string|max:200',
                'Telefono'=>'required|string|max:50',
                'IdCiudad'=>'required|int',
                'Especializacion'=>'required|string|max:100',
                'Escalafon'=>'required|string|max:50',
                'Coordinador'=>'required|string|max:20',
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
            'PrimerNombreMaes'=> ['required', 'string', 'max:50', 'regex:/^[A-Za-z]*$/u'],             
            'PrimerApellidoMaes'=>['required', 'string', 'max:50', 'regex:/^[A-Za-z]*$/u'],             
            'SegundoApellidoMaes'=>['required', 'string', 'max:50', 'regex:/^[A-Za-z]*$/u'],             
            'IdTipoDocumento'=>'required|int',            
            'NumeroDocumento'=>'required|string|regex:/^[0-9]+$/||max:12|unique:maestros,NumeroDocumento,'.$id.',IdMaestro',
            'FechaNacimiento'=>'required|date',
            'IdGenero'=>'required|int',
            'IdTipoSangre'=>'required|int',                
            'Correo'=>'required|email|max:200|unique:maestros,Correo,'.$id.',IdMaestro',
            'Direccion'=>'required|string|max:200',
            'Telefono'=>'required|string|max:50',
            'IdCiudad'=>'required|int',
            'Especializacion'=>'required|string|max:100',
            'Escalafon'=>'required|string|max:50',
            'Coordinador'=>'required|string|max:20',
            'EstadoMaestro'=>'required|int'
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
