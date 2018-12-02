<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Secretaria;
use App\User;
use App\Sede;
use App\TipoDocumento;

class SecretariaController extends Controller
{    
    public function index()
    {
        $idusuario = Auth::user()->IdUsers;
        $usuario = User::where('IdUsers','=', $idusuario)->select('users.*')->first();

        switch ($usuario['IdTipoUsuario']) {
            case '1':
                        $secretaria = Secretaria::join('sedes','secretarias.IdSede','=','sedes.IdSede')->where('EstadoSecretaria','=', true)->select('secretarias.*')->get();
                        $sedes = Sede::where('EstadoSede','=', true)->select('sedes.*')->get();
                        $tipodocumentos = TipoDocumento::where('EstadoTipoDocumento','=', true)->select('tipodocumentos.*')->get();
                        return view('secretaria.index', compact('secretaria','sedes', 'tipodocumentos'));
                break;
            
            default:
                    return redirect()->route('secretaria.index')->with('error','Los permisos a este modulo no los tiene asignados');       
                break;
        }
    }
 
    public function store(Request $request)
    {
        $materias = request()->validate([
            'PrimerNombreSecretaria'=>'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
            'PrimerApellidoSecretaria'=>'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
            'SegundoApellidoSecretaria'=>'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
            'IdTipoDocumento'=>'required|int',
            'NumeroDocumentoSecretaria'=>'required|string',
            'CorreoSecretaria'=>'required|string',
            'DireccionSecretaria'=>'required|string',
            'TelefonoSecretaria'=>'required|string',
            'EstadoSecretaria'=>'required|int',
            'IdSede'=>'required|int'
        ]);
 
        if($request['IdSecretaria'] != 0){
            return $this->update($request, $request['IdSecretaria']);        
        }else{
            $usuario = new User();
            $usuario->email = $request['CorreoSecretaria'];
            $usuario->Contrasena = $request['NumeroDocumentoSecretaria'];
            $usuario->IdTipoUsuario = 3;
            $usuario->EstadoUsuario = true;
            $usuario->save();
            
            Secretaria::create($request->all());
            return redirect()->route('secretaria.index')->with('success','La secretaria se registro correctamente');    
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
