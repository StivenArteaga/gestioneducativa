<?php

namespace App\Http\Controllers;

use App\Coordinador;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCoordinadorRequest;
use App\Http\Requests\UpdateCoordinadorRequest;
use App\TipoDocumento;
use App\Genero;
use App\Municipio;
use App\Sede;
use App\User;
use App\TipoSangre;

class CoordinadorController extends Controller
{
    
    public function index()
    {
        $coordinadores = Coordinador::select('coordinadores.*', 'tipodocumentos.*', 'tiposangres.*','generos.*', 'municipios.*', 'sedes.*')
        ->join('tipodocumentos', 'tipodocumentos.IdTipoDocumento', 'coordinadores.IdTipoDocumento')
        ->join('generos', 'generos.IdGenero', 'coordinadores.IdGenero')
        ->join('tiposangres', 'tiposangres.IdTipoSangre', 'coordinadores.IdTipoSangre')
        ->join('municipios', 'municipios.IdMunicipio', 'coordinadores.IdMunicipio')
        ->join('sedes', 'sedes.IdSede', 'coordinadores.IdSede')
        ->where('Estado', true)
        ->get();

        return view('coordinadores.index', compact('coordinadores'));
    }

    
    public function create()
    {
        $tipodocumentos = TipoDocumento::pluck('NombreTipoDocumento', 'IdTipoDocumento');
        $generos = Genero::pluck('NombreGenero', 'IdGenero');
        $ciudades = Municipio::pluck('NombreMunicipio', 'IdMunicipio');
        $sedes = Sede::pluck('NombreSede', 'IdSede');
        $tiposangres = TipoSangre::pluck('NombreTipoSangre', 'IdTipoSangre');

        return view('coordinadores.create', compact('tipodocumentos', 'generos', 'ciudades', 'sedes', 'tiposangres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCoordinadorRequest $request)
    {

        $user = new User();
        $user->email = $request->get('Correo');
        $user->Contrasena = bcrypt($request->get('NumeroDocumento'));
        $user->IdTipoUsuario = 2;
        $user->EstadoUsuario = true;
        $user->save();

        $coordinador = new Coordinador();
        $coordinador->PrimerNombre = $request->get('PrimerNombre');
        $coordinador->SegundoNombre = $request->get('SegundoNombre');
        $coordinador->PrimerApellido = $request->get('PrimerApellido');
        $coordinador->SegundoApellido = $request->get('SegundoApellido');
        $coordinador->IdTIpoDocumento = $request->get('IdTipoDocumento');
        $coordinador->NumeroDocumento = $request->get('NumeroDocumento');
        $coordinador->FechaNacimiento = $request->get('FechaNacimiento');
        $coordinador->IdGenero = $request->get('IdGenero');
        $coordinador->IdTipoSangre = $request->get('IdTipoSangre');
        $coordinador->Correo = $request->get('Correo');
        $coordinador->Direccion = $request->get('Direccion');
        $coordinador->Telefono = $request->get('Telefono');
        $coordinador->IdMunicipio = $request->get('IdMunicipio');
        $coordinador->IdSede = $request->get('IdSede');
        $coordinador->IdUser = $user->IdUsers;
        $coordinador->save();
        
        return redirect('coordinadores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function show(Coordinador $coordinador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coordinador = Coordinador::findOrFail($id);
        $tipodocumentos = TipoDocumento::pluck('NombreTipoDocumento', 'IdTipoDocumento');
        $generos = Genero::pluck('NombreGenero', 'IdGenero');
        $ciudades = Municipio::pluck('NombreMunicipio', 'IdMunicipio');
        $sedes = Sede::pluck('NombreSede', 'IdSede');
        $tiposangres = TipoSangre::pluck('NombreTipoSangre', 'IdTipoSangre');

        return view('coordinadores/edit', compact('coordinador', 'tipodocumentos', 'generos', 'ciudades', 'sedes', 'tiposangres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoordinadorRequest $request, $id)
    {
        $coordinador = Coordinador::findOrFail($id);
        $coordinador->update($request->all());

        return redirect('coordinadores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coordinador  $coordinador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $coordinador = Coordinador::findOrFail($id);
            if ($coordinador != null) {
                if ($coordinador->Estado == true) {
                    $coordinador->Estado = false;
                    $coordinador->save();
                }else {
                    $coordinador->Estado = true;
                    $coordinador->save();
                }
            }else {
                $coordinador->Estado = false;
                $coordinador->save();
            }
            
            return response()->json([
                'message' => 'El Coordinador '. $coordinador->PrimerNombre. ' '. $coordinador->PrimerApellido. ' Ha sido eliminado exitosamente!'
            ]);
        }
    }
}
