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
                        $secretaria = Secretaria::join('sedes','secretarias.IdSede','=','sedes.IdSede')->where('EstadoSecretaria','=', true)->select('secretarias.*', 'sedes.*')->get();
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
            'CorreoSecretaria'=>'required|email',
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
                        
            $secretaria = new Secretaria();
            $secretaria->PrimerNombreSecretaria = $request['PrimerNombreSecretaria'];
            $secretaria->SegundoNombreSecretaria = $request['SegundoNombreSecretaria'];
            $secretaria->PrimerApellidoSecretaria = $request['PrimerApellidoSecretaria'];
            $secretaria->SegundoApellidoSecretaria = $request['SegundoApellidoSecretaria'];
            $secretaria->IdTipoDocumento = $request['IdTipoDocumento'];
            $secretaria->NumeroDocumentoSecretaria = $request['NumeroDocumentoSecretaria'];
            $secretaria->CorreoSecretaria = $request['CorreoSecretaria'];
            $secretaria->DireccionSecretaria = $request['DireccionSecretaria'];
            $secretaria->TelefonoSecretaria = $request['TelefonoSecretaria'];
            $secretaria->EstadoSecretaria = $request['EstadoSecretaria'];
            $secretaria->IdSede = $request['IdSede'];
            $secretaria->IdUserSecretaria = $usuario->IdUsers;
            $secretaria->save();

            return redirect()->route('secretaria.index')->with('success','La secretaria se registro correctamente');    
        }
    }

    public function edit ($id){
        $secretaria = Secretaria::findOrFail($id);
        return response()->json($secretaria);
    }

    public function update(Request $request, $id)
    {        
        $materias = request()->validate([
            'PrimerNombreSecretaria'=>'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
            'PrimerApellidoSecretaria'=>'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
            'SegundoApellidoSecretaria'=>'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
            'IdTipoDocumento'=>'required|int',
            'NumeroDocumentoSecretaria'=>'required|string|max:50|unique:secretarias,NumeroDocumentoSecretaria,'.$id.',IdSecretaria,EstadoSecretaria,'.true,
            'CorreoSecretaria'=>'required|email|unique:secretarias,CorreoSecretaria,'.$id.',IdSecretaria,EstadoSecretaria,'.true,
            'DireccionSecretaria'=>'required|string',
            'TelefonoSecretaria'=>'required|string',
            'EstadoSecretaria'=>'required|int',
            'IdSede'=>'required|int'
        ]);


        $secretaria = Secretaria::find($id);
        $secretaria->PrimerNombreSecretaria = $request['PrimerNombreSecretaria'];
        $secretaria->SegundoNombreSecretaria = $request['SegundoNombreSecretaria'];
        $secretaria->PrimerApellidoSecretaria = $request['PrimerApellidoSecretaria'];
        $secretaria->SegundoApellidoSecretaria = $request['SegundoApellidoSecretaria'];
        $secretaria->IdTipoDocumento = $request['IdTipoDocumento'];
        $secretaria->NumeroDocumentoSecretaria = $request['NumeroDocumentoSecretaria'];
        $secretaria->CorreoSecretaria = $request['CorreoSecretaria'];
        $secretaria->DireccionSecretaria = $request['DireccionSecretaria'];
        $secretaria->TelefonoSecretaria = $request['TelefonoSecretaria'];
        $secretaria->EstadoSecretaria = $request['EstadoSecretaria'];
        $secretaria->IdSede = $request['IdSede'];
        $secretaria->save();
        return redirect()->route('secretaria.index')->with('success','La secretaria se actualizo correctamente');    
    }

    public function destroy($id)
    {        
            $secretaria = Secretaria::findOrFail($id);
            if ($secretaria != null) {
                if ($secretaria->EstadoSecretaria == true) {
                    $secretaria->EstadoSecretaria = false;
                    $secretaria->save();
                }else {
                    $secretaria->EstadoSecretaria = true;
                    $secretaria->save();
                }
            }else {
                $secretaria->EstadoSecretaria = false;
                $secretaria->save();
            }
            
            return redirect()->route('secretaria.index')->with('success','La secretaria se ha eliminado correctamente');    
        
    }
}
