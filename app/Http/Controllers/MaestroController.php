<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Maestro;
use App\Ciudad;
use App\TipoSangre;
use App\TipoDocumento; 
use App\Genero;
use App\Asignatura;
use App\DetalleAsignaturaDocente;
use App\User;
use Exception;

class MaestroController extends Controller
{
    public function index()
    { 
        $maestro = Maestro::join('tipodocumentos', 'maestros.IdTipoDocumento', '=', 'tipodocumentos.IdTipoDocumento')
                            ->join('generos', 'maestros.IdGenero', '=', 'generos.IdGenero')
                            ->join('tiposangres', 'maestros.IdTipoSangre', '=', 'tiposangres.IdTipoSangre')
                            ->join('ciudades', 'maestros.IdCiudad', '=', 'ciudades.IdCiudad')                            
                            ->where('EstadoMaestro', true)
                            ->select('maestros.*', 'tipodocumentos.NombreTipoDocumento', 'generos.NombreGenero', 
                                    'NombreTipoSangre', 'ciudades.NombreCiudad')
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
        $correoglobal = '';
        try{
            if($request['IdAsignatura'] != null){
                if ($request['IdMaestro'] != 0) {
                    $this->update($request, $request['IdMaestro']);
                    return redirect()->route('maestro.index')->with('success','La actualización del docente se realizo con exito');
                } else {
        
                    request()->validate([                    
                        'PrimerNombreMaes'=> ['required', 'string', 'max:50', 'regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)+$/'],             
                        'PrimerApellidoMaes'=>['required', 'string', 'max:50', 'regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u'],             
                        'SegundoApellidoMaes'=>['required', 'string', 'max:50', 'regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u'],             
                        'IdTipoDocumento'=>'required|int',            
                        'NumeroDocumento'=>'required|string|max:12|regex:/^[0-9]+$/',
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
                    
                    $existesede = Maestro::where('NumeroDocumento', '=', $request['NumeroDocumento'])
                                      ->where('EstadoMaestro', '=', true)
                                      ->first();
                        
                    if($existesede != null){
                          return redirect()->route('maestro.index')->with('error','Ya existe un docente con este número de documento');                                                                 
                    }else{
    
                        $existecorreo = Maestro::where('Correo', '=', $request['Correo'])
                                      ->where('EstadoMaestro', '=', true)
                                      ->first();
    
                        if($existecorreo != null){
                            return redirect()->route('maestro.index')->with('error','Ya existe un docente con este correo electronico');                                                                   
                        }else{
    
                            $User = new User();
                            $User->Contrasena = Hash::make($request['NumeroDocumento']);
                            $User->email = $request['Correo'];
                            $User->IdTipoUsuario = 4;
                            $User->EstadoUsuario = 'Activo';
                            $User->save();

                            $correoglobal = $request['Correo'];
                            $request['IdUser'] = $User->IdUsers;
                            Maestro::create($request->all());                    
    
                            $All = Maestro::all();
                            $IdMaestro =$All->last();  
        
                            foreach ($request['IdAsignatura'] as $key => $value) {
                                $array = ([
                                    'IdAsignaturaDetalleAsignaturaDocente',
                                    'IdDocenteDetalleAsignaturaDocente'
                                ]);
        
                                $array['IdDocenteDetalleAsignaturaDocente'] = $IdMaestro['IdMaestro'];
                                $array['IdAsignaturaDetalleAsignaturaDocente'] = $value;
                                DetalleAsignaturaDocente::create($array);
                            }
        
                            return redirect()->route('maestro.index')->with('success','El registro del docente se realizo con exito');
                        }                                  
                    }   
                } 
            }else{
                return redirect()->route('maestro.index')->with('error','Al docente no se le ha asignado asignaturas');   
            }               
        }catch (\Exception $e) {

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
        $Asignatura = DetalleAsignaturaDocente::where('IdDocenteDetalleAsignaturaDocente', '=', $id)->get()->toArray();                     
        return response()->json(['maestros'=>$maestros, 'asignaturas'=>$Asignatura]);

    }

    public function update(Request $request, $id)
    {              
        request()->validate([            
            'PrimerNombreMaes'=> ['required', 'string', 'max:50', 'regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)+$/'],             
            'PrimerApellidoMaes'=>['required', 'string', 'max:50', 'regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u'],             
            'SegundoApellidoMaes'=>['required', 'string', 'max:50', 'regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u'],             
            'IdTipoDocumento'=>'required|int',            
            'NumeroDocumento'=>'required|string|regex:/^[0-9]+$/|max:12|unique:maestros,NumeroDocumento,'.$id.',IdMaestro,EstadoMaestro,'.true,
            'FechaNacimiento'=>'required|date',
            'IdGenero'=>'required|int',
            'IdTipoSangre'=>'required|int',                
            'Correo'=>'required|email|max:200|unique:maestros,Correo,'.$id.',IdMaestro,EstadoMaestro,'.true,
            'Direccion'=>'required|string|max:200',
            'Telefono'=>'required|string|max:50',
            'IdCiudad'=>'required|int',
            'Especializacion'=>'required|string|max:100',
            'Escalafon'=>'required|string|max:50',
            'Coordinador'=>'required|string|max:20',
            'EstadoMaestro'=>'required|int'
        ]);

            Maestro::find($id)->update($request->all());
        
            $IdMaestro = Maestro::findOrFail($id);                    
            $DeleteAsig = DetalleAsignaturaDocente::where('IdDocenteDetalleAsignaturaDocente', '=', $id)->get()->toArray();
    
            foreach ($DeleteAsig as $key => $value) {
                $elim = DetalleAsignaturaDocente::where('IdDocenteDetalleAsignaturaDocente','=',$value['IdDocenteDetalleAsignaturaDocente'] )->firstOrFail();
                $elim->delete();
            }
            
            foreach ($request['IdAsignatura'] as $key => $value) {                                

                $valid = DetalleAsignaturaDocente::where('IdAsignaturaDetalleAsignaturaDocente', '=', $value)
                                                 ->where('IdDocenteDetalleAsignaturaDocente', '=', $id)
                                                 ->first();
                if($valid == null){
                    $detall = ([
                        'IdAsignaturaDetalleAsignaturaDocente',
                        'IdDocenteDetalleAsignaturaDocente'
                    ]);                                               
                                        
                        $detall['IdDocenteDetalleAsignaturaDocente'] = $id;
                        $detall['IdAsignaturaDetalleAsignaturaDocente'] = $value;
                        DetalleAsignaturaDocente::create($detall);                
                }
            }  

            return redirect()->route('maestro.index')->with('success','El registro del maestro se actualizo con exito');   
    
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $maestro = Maestro::findOrFail($id);
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
            
            return response()->json([
                'message' => 'El Docente '. $maestro->PrimerNombreMaes. ' '.$maestro->PrimerApellidoMaes.' Ha sido eliminado exitosamente!'
            ]);
        }
    }

}
