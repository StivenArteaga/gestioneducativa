<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Alumno;
use App\TipoDocumento;
use App\Departamento;
use App\Municipio;
use App\Ciudad;
use App\Genero;   
use App\Eps;
use App\TipoSangre; 
use App\TipoVictima;
use App\Resguardo;
use App\Etnia;
use App\Paretesco; 
use App\Grado;
use App\Salon;
use App\Acudiente;
use App\Salud;
use App\Academica;
use App\Usuario;
use App\DetalleAlumnoAcudiente;
use App\Matricula;
use App\Grupo;
use App\TipoAcudiente;
use Exception;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       $tipodocumentos = TipoDocumento::all();
       $departamentos = Departamento::all();
       $municipios = Municipio::all();
       $ciudades = Ciudad::all();
       $generos = Genero::all();
       $eps = Eps::all();
       $tiposangres = TipoSangre::all();
       $tipovictimas = TipoVictima::all();
       $resguardos = Resguardo::all();
       $etnias = Etnia::all();
       $parentescos = Paretesco::all();
       $grados = Grado::all();
       $salones = Salon::all();
       $tipoacudiente = TipoAcudiente::all();

        $alumnos = Alumno::where('EstadoAlumno', true)->get();        
        return view('alumno.index', compact('alumnos', 'tipodocumentos', 'departamentos', 'ciudades', 'generos', 
                                            'eps', 'tiposangres', 'tipovictimas', 'resguardos', 'etnias',
                                             'parentescos','municipios', 'grados', 'salones','tipoacudiente'));
    }

    public function autoincre(){
        $codigoInterno = Alumno::all();
        $codigo = $codigoInterno->last();
        $numCodigog = $codigo['IdAlumno'];
        $numCodigo = ($numCodigog == null) ? 1 : $numCodigog+1 ;

        $codigoMatricula = Matricula::all();
        $matricula = $codigoInterno->last();
        $numMatriculas = $matricula['IdAlumno'];
        $numMatricula = ($numMatriculas == null) ? 1 : $numMatriculas+1 ;

        return response()->json(['codigo'=>$numCodigo, 'numMatricula'=>$numMatricula]);
    }

    public function listalum($IdGrado)
    {        
        $infoacad = Academica::where('IdGrado', '=', $IdGrado)->get();
        $fininfo = $infoacad->last();
        $numLista;
        if ($fininfo['Numerolista'] != null) {
            $numLista = $fininfo['Numerolista']+1;
        } else {
            $numLista = 1;
        }
        
        return response()->json($numLista);
    }

    
    public function create()
    {
       $tipodocumentos = TipoDocumento::all();
       $departamentos = Departamento::all();
       $municipios = Municipio::all();
       $ciudades = Ciudad::all();
       $generos = Genero::all();
       $eps = Eps::all();
       $tiposangres = TipoSangre::all();
       $tipovictimas = TipoVictima::all();
       $resguardos = Resguardo::all();
       $etnias = Etnia::all();
       $parentescos = Parentesco::all();

       return view('alumno.index', compact('tipodocumentos', 'departamentos', 'ciudades', 'generos', 'eps', 
                                            'tiposangres', 'tipovictimas', 'resguardos', 'etnias', 'parentescos','municipios'));

    }

    
    public function store($request)
    {
        
        $Idalumnoglobl = 0;
        try{
            $mi_array = json_decode($request);                        
            /*$usuario = new Usuario();
    
            $usuario->NombreUsuario=$request->get('NumeroDocumento');  
            $usuario->Contrasena = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';
            $usuario->TipoUsuario = 2;
    
            $usuario->id_autor=$autor->idautor;
            $libro->save();*/            
            if ($mi_array->IdAlumno != "" ) {            
                $this->update($mi_array, $mi_array->IdAlumno);            
                return redirect()->route('alumno.index')->with('success','La actualización de la matricula del alumno se registro con exito');
            } else {            
                                
            //Validar datos personales obligatorios del alumno
            if($mi_array->PrimerNombre == "" || $mi_array->PrimerApellido==""|| $mi_array->SegundoApellido=="" || $mi_array->Correo ==""
               ||$mi_array->IdTipoDocumento == ""||$mi_array->NumeroDocumento == "" ||$mi_array->IdMunicipioExpedido == "" ||$mi_array->IdGenero == ""
               ||$mi_array->FechaNacimiento == "" ||$mi_array->IdCiudadNacimiento == "" ||$mi_array->IdCiudadResidencia == "" ||$mi_array->Direccion == ""
               ||$mi_array->Zona == "" ||$mi_array->Telefono == "" ||$mi_array->EstadoAlumno == "")
            {                
                return response()->json(['status'=>'warning','message' => 'Por favor, diligencia los campos que estan marcados con un (*) en la información personal del alumno. Estos campos son obligatorios para registrar un alumno']);                            
            }else{                                                                
                if($mi_array->IdEps ==""||$mi_array->IdTipoSangre =="" || $mi_array->CarnetSisben =="" || $mi_array->PuntajeSisben =="" ||$mi_array->Estrato =="")
                {                    
                    return response()->json(['status'=>'warning','message' => 'Por favor, diligencia los campos que estan marcados con un (*) en la información de salud del alumno. Estos campos son obligatorios para registrar un alumno']);                            
                }else{                                        
                    if($mi_array->IdTipoAcudiente==""||$mi_array->PrimerNombreAcu=="" ||$mi_array->PrimerApellidoAcu=="" ||$mi_array->SegundoApellidoAcu=="" || $mi_array->IdTipoDocumento=="" ||
                        $mi_array->IdMunicipioExpedicion=="" ||$mi_array->IdParentesco=="" ||$mi_array->DireccionHogar=="" ||$mi_array->TelefonoCelular=="" ||
                        $mi_array->NumeroDocumentoAcu=="" || $mi_array->CorreoAcu=="")
                    {
                        return response()->json(['status'=>'warning','message' => 'Por favor, diligencia los campos que estan marcados con un (*) en la información del acudiente del alumno. Estos campos son obligatorios para registrar un alumno']);                             
                    }else{                                                
                        if($mi_array->IdGrado == ""||$mi_array->Numerolista == ""||$mi_array->Estado == ""||$mi_array->FechaEstado == ""||
                            $mi_array->CodigoInterno == ""||$mi_array->NumeroMatricula == ""||$mi_array->InstitucionOrigen == ""||$mi_array->EstadoAcademicoAnterior == ""||
                            $mi_array->EstadoMatriculaFinal == "")
                        {
                            return response()->json(['status'=>'warning','message' => 'Por favor, diligencia los campos que estan marcados con un (*) en la información academica del alumno. Estos campos son obligatorios para registrar un alumno']);                                 
                        }else{                             
                            
                                $existeusuario = User::where('users.email','=', $mi_array->Correo)                                                     
                                                     ->where('users.EstadoUsuario', '=', 'Activo')                                                     
                                                     ->select('users.*')
                                                     ->first();
                            
                                if($existeusuario != null)
                                {
                                    return response()->json(['status'=>'error','message' => 'Ya existe un usuario con este correo en el sistema, por favor verifica tu correo electronico']);        
                                }else
                                {
                                                  
                                 $usuarioalumno = new User();
                                 $usuarioalumno->email = $mi_array->Correo;
                                 $usuarioalumno->Contrasena = Hash::make($mi_array->NumeroDocumento);
                                 $usuarioalumno->IdTipoUsuario = 2;
                                 $usuarioalumno->EstadoUsuario = 'Activo';
                                 $usuarioalumno->save();

                                 $idusuarioalumno = User::where('email', '=', $mi_array->Correo)
                                                         ->select('users.*')
                                                             ->first();

                                //$mi_array->flash();                                            

                                $alumnos = new Alumno();
                                $alumnos->PrimerNombre = $mi_array->PrimerNombre;                                                             
                                $alumnos->SegundoNombre = $mi_array->SegundoNombre;                                                           
                                $alumnos->PrimerApellido = $mi_array->PrimerApellido;                                                             
                                $alumnos->SegundoApellido = $mi_array->SegundoApellido;                                                             
                                $alumnos->Correo = $mi_array->Correo;                                                          
                                $alumnos->IdTipoDocumento = (int)$mi_array->IdTipoDocumento;                                                           
                                $alumnos->NumeroDocumento = $mi_array->NumeroDocumento;                                                           
                                $alumnos->IdMunicipioExpedido = (int)$mi_array->IdMunicipioExpedido;                                                          
                                $alumnos->IdGenero = (int)$mi_array->IdGenero;                                                          
                                $alumnos->FechaNacimiento = $mi_array->FechaNacimiento;                                                          
                                $alumnos->IdCiudadNacimiento  = (int)$mi_array->IdCiudadNacimiento;                                                           
                                $alumnos->IdCiudadResidencia = (int)$mi_array->IdCiudadResidencia;                                                        
                                $alumnos->Direccion = $mi_array->Direccion;                                                            
                                $alumnos->Zona = $mi_array->Zona;                                                           
                                $alumnos->Telefono = $mi_array->Telefono;                                                                   
                                $alumnos->Usuario = $idusuarioalumno->IdUsers;                                      
                                $alumnos->EstadoAlumno = 1;                                                            
                                $alumnos->save();

                                $IdAl = $mi_array->NumeroDocumento;
                                $gu = Alumno::where('NumeroDocumento','=', $IdAl)
                                            ->select('alumnos.*')
                                            ->firstOrFail();   

                                $mi_array->IdAlumno = $gu['IdAlumno'];                                                                               
                                $Idalumnoglobl = $mi_array->IdAlumno;                                
                                //Guardar datos de salud del alumno en la tabla salud                                
                                $salud = new Salud();                                
                                $salud->IdEps = (int)$mi_array->IdEps;                                
                                $salud->IdTipoSangre = (int)$mi_array->IdTipoSangre;                                
                                $salud->Ips = $mi_array->Ips;                                
                                $salud->Ars = $mi_array->Ars;                                
                                $salud->CarnetSisben = $mi_array->CarnetSisben;                                
                                $salud->PuntajeSisben = $mi_array->PuntajeSisben;                                
                                $salud->Estrato = $mi_array->Estrato;                                
                                $salud->FuenteRecursos = $mi_array->FuenteRecursos;                                
                                $salud->MadreCabFamilia = $mi_array->MadreCabFamilia;                                
                                $salud->HijoDeMadreCabFamilia = $mi_array->HijoDeMadreCabFamilia;                                
                                $salud->BeneVeteranoMilitar = $mi_array->BeneVeteranoMilitar;                                
                                $salud->BeneHeroeNacional = $mi_array->BeneHeroeNacional;                                
                                $salud->IdVictima = (int)$mi_array->IdVictima;                                
                                $salud->FechaExpulsion = $mi_array->FechaExpulsion;                                
                                $salud->IdMunicipio = (int)$mi_array->IdMunicipio;                                
                                $salud->IdResguardo = (int)$mi_array->IdResguardo;                                
                                $salud->IdEtnia = (int)$mi_array->IdEtnia;                                                             
                                $salud->IdAlumno = $mi_array->IdAlumno;                                                                                           
                                $salud->save();                                
                                
                                //Guardar datos del acudiente del alumno en la tabla acudiente
                                $acudienteexiste = Acudiente::where('CorreoAcu','=',$mi_array->CorreoAcu)  
                                                            ->select('acudientes.*')
                                                            ->first();                                                            
                                
                                if($acudienteexiste != null)
                                {
                                
                                    $detallealumnoacudiente = new DetalleAlumnoAcudiente();
                                    $detallealumnoacudiente->IdAcudiente = $acudienteexiste['IdAcudiente'];
                                    $detallealumnoacudiente->IdTipoAcudiente = (int)$mi_array->IdTipoAcudiente;
                                    $detallealumnoacudiente->IdAlumno = $mi_array->IdAlumno;
                                    $detallealumnoacudiente->save();   
                                }
                                else
                                {
                                    $usuarioacudiente = new User();
                                    $usuarioacudiente->email = $mi_array->CorreoAcu;
                                    $usuarioacudiente->Contrasena = Hash::make($mi_array->NumeroDocumentoAcu);
                                    $usuarioacudiente->EstadoUsuario = "Activo";
                                    $usuarioacudiente->IdTipoUsuario = 3;
                                    $usuarioacudiente->save();
                                    
                                    $idusuarioacudiente = User::where('email','=',$mi_array->CorreoAcu)
                                                              ->select('users.*')
                                                              ->first();                                    
                                    
                                    $acudienteuno = new Acudiente();                                    
                                    $acudienteuno->PrimerNombreAcu = $mi_array->PrimerNombreAcu;                                    
                                    $acudienteuno->SegundoNombreAcu = $mi_array->SegundoNombreAcu;                                    
                                    $acudienteuno->PrimerApellidoAcu = $mi_array->PrimerApellidoAcu;                                    
                                    $acudienteuno->SegundoApellidoAcu = $mi_array->SegundoApellidoAcu;                                    
                                    $acudienteuno->IdTipoDocumento = (int)$mi_array->IdTipoDocumento;                                    
                                    $acudienteuno->IdMunicipioExpedicion = (int)$mi_array->IdMunicipioExpedicion;                                    
                                    $acudienteuno->IdParentesco = (int)$mi_array->IdParentesco;                                    
                                    $acudienteuno->DireccionHogar = $mi_array->DireccionHogar;                                    
                                    $acudienteuno->TelefonoTrabajo = $mi_array->TelefonoTrabajo;                                    
                                    $acudienteuno->TelefonoCelular = $mi_array->TelefonoCelular;                                    
                                    $acudienteuno->Ocupacion = $mi_array->Ocupacion;                                
                                    $acudienteuno->NumeroDocumentoAcu = $mi_array->NumeroDocumentoAcu;                                    
                                    $acudienteuno->CorreoAcu = $mi_array->CorreoAcu;                                    
                                    $acudienteuno->IdUsuario = $idusuarioacudiente['IdUsers'];                                    
                                    $acudienteuno->save();                                    
                                    
                                    $idacudiente = Acudiente::where('NumeroDocumentoAcu', '=', $mi_array->NumeroDocumentoAcu)
                                                            ->select('acudientes.*')
                                                            ->first();

                                    
                                    $detallealumnoacudiente = new DetalleAlumnoAcudiente();                                    
                                    $detallealumnoacudiente->IdAcudiente = $idacudiente['IdAcudiente'];                                    
                                    $detallealumnoacudiente->IdTipoAcudiente = (int)$mi_array->IdTipoAcudiente;                                    
                                    $detallealumnoacudiente->IdAlumno = $mi_array->IdAlumno;                                    
                                    $detallealumnoacudiente->save();                                    
                                }
                                
                                //Validar si trato de ingresar un segundo acudiente
                                if($mi_array->IdTipoAcudiente2 !=""||$mi_array->PrimerNombreAcu2 !="" ||$mi_array->PrimerApellidoAcu !="" ||$mi_array->SegundoApellidoAcu2 !="" || $mi_array->IdTipoDocumento2 !="" ||
                                    $mi_array->IdMunicipioExpedicion2 !="" ||$mi_array->IdParentesco2 !="" ||$mi_array->DireccionHogar2 !="" ||$mi_array->TelefonoCelular2 !="" ||
                                    $mi_array->NumeroDocumentoAcu2 !="" || $mi_array->CorreoAcu2 !="")
                                {
                                    if($mi_array->IdTipoAcudiente2 ==""||$mi_array->PrimerNombreAcu2 =="" ||$mi_array->PrimerApellidoAcu =="" ||$mi_array->SegundoApellidoAcu2 =="" || $mi_array->IdTipoDocumento2 =="" ||
                                    $mi_array->IdMunicipioExpedicion2 =="" ||$mi_array->IdParentesco2 =="" ||$mi_array->DireccionHogar2 =="" ||$mi_array->TelefonoCelular2 =="" ||
                                    $mi_array->NumeroDocumentoAcu2 =="" || $mi_array->CorreoAcu2 =="")
                                    {
                                        return response()->json(['status'=>'warning','message' => 'Si vas asignar un segundo acudiente recuerda diligenciar los campos que estan marcados con un (*) en la información del segundo acudiente del alumno. Estos campos son obligatorios para registrar un alumno']);
                                    }
                                    else
                                    {
                                        $IdAlumno2 = $mi_array->IdAlumno;
                                    //Guardar datos del segundo acudiente del alumno en la tabla acudiente
                                    $acudienteexiste2 = Acudiente::where('CorreoAcu','=',$mi_array->CorreoAcu2)  
                                                            ->select('acudientes.*')
                                                            ->first();                                                            

                                    if($acudienteexiste2 != null)
                                    {
                                        $detallealumnoacudiente2 = new DetalleAlumnoAcudiente();
                                        $detallealumnoacudiente2->IdAcudiente = $acudienteexiste2['IdAcudiente'];
                                        $detallealumnoacudiente2->IdTipoAcudiente = (int)$mi_array->IdTipoAcudiente2;
                                        $detallealumnoacudiente2->IdAlumno = $IdAlumno2;
                                        $detallealumnoacudiente2->save();   
                                    }
                                    else
                                    {
                                        
                                        $usuarioacudiente2 = new User();
                                        $usuarioacudiente2->email = $mi_array->CorreoAcu2;
                                        $usuarioacudiente2->Contrasena = Hash::make($mi_array->NumeroDocumentoAcu2);
                                        $usuarioacudiente2->EstadoUsuario = "Activo";
                                        $usuarioacudiente->IdTipoUsuario = 3;
                                        $usuarioacudiente2->save();

                                        $idusuarioacudiente2 = User::where('email','=',$mi_array->CorreoAcu2)
                                                                ->select('users.*')
                                                                ->first();       
                                    
                                        $acudienteuno2 = new Acudiente();
                                        $acudienteuno2->PrimerNombreAcu = $mi_array->PrimerNombreAcu2;
                                        $acudienteuno2->SegundoNombreAcu = $mi_array->SegundoNombreAcu2;
                                        $acudienteuno2->PrimerApellidoAcu = $mi_array->PrimerApellidoAcu2;
                                        $acudienteuno2->SegundoApellidoAcu = $mi_array->SegundoApellidoAcu2;
                                        $acudienteuno2->IdTipoDocumento =(int)$mi_array->IdTipoDocumento2;
                                        $acudienteuno2->IdMunicipioExpedicion = (int)$mi_array->IdMunicipioExpedicion2;
                                        $acudienteuno2->IdParentesco = (int)$mi_array->IdParentesco2;
                                        $acudienteuno2->DireccionHogar = $mi_array->DireccionHogar2;
                                        $acudienteuno2->TelefonoTrabajo = $mi_array->TelefonoTrabajo2;
                                        $acudienteuno2->TelefonoCelular = $mi_array->TelefonoCelular2;
                                        $acudienteuno2->Ocupacion = $mi_array->Ocupacion2;
                                        $acudienteuno2->NumeroDocumentoAcu = $mi_array->NumeroDocumentoAcu2;
                                        $acudienteuno2->CorreoAcu = $mi_array->CorreoAcu2;
                                        $acudienteuno2->IdUsuario = $idusuarioacudiente2['IdUsers'];
                                        $acudienteuno2->save();
                                        
                                        $idacudiente2 = Acudiente::where('NumeroDocumentoAcu', '=', $mi_array->NumeroDocumentoAcu2)
                                                                ->select('acudientes.*')
                                                                ->first();
                                    
                                        $detallealumnoacudiente2 = new DetalleAlumnoAcudiente();
                                        $detallealumnoacudiente2->IdAcudiente = $idacudiente2['IdAcudiente'];
                                        $detallealumnoacudiente2->IdTipoAcudiente = (int)$mi_array->IdTipoAcudiente2;
                                        $detallealumnoacudiente2->IdAlumno = $IdAlumno2;
                                        $detallealumnoacudiente2->save();
                                    }
                                    }
                                }
                                
                                //Guardar la información academica del alumno                                                               
                                $infacademica = new Academica();
                                $infacademica->IdGrado = (int)$mi_array->IdGrado;
                                $infacademica->valorPension = $mi_array->valorPension;
                                $infacademica->valorMatricula = $mi_array->valorMatricula;
                                $infacademica->Numerolista = $mi_array->Numerolista;
                                $infacademica->Estado = $mi_array->Estado;
                                $infacademica->FechaEstado = $mi_array->FechaEstado;
                                $infacademica->CodigoInterno = $mi_array->CodigoInterno;
                                $infacademica->NumeroMatricula = $mi_array->NumeroMatricula;
                                $infacademica->InstitucionOrigen = $mi_array->InstitucionOrigen;
                                $infacademica->EstadoAcademicoAnterior = $mi_array->EstadoAcademicoAnterior;
                                $infacademica->EstadoMatriculaFinal = $mi_array->EstadoMatriculaFinal;
                                $infacademica->CondicionFinAno = $mi_array->CondicionFinAno;
                                $infacademica->CausaTraslado = $mi_array->CausaTraslado;
                                $infacademica->IdAlumno = $mi_array->IdAlumno;
                                $infacademica->save();                                
                                
                                $insmatricula = new Matricula();
                                if ($mi_array->valorMatricula != "") {
                                    $insmatricula->valorMatricula = $mi_array->valorMatricula;
                                }
                                
                                $insmatricula->IdAlumno = (int)$mi_array->IdAlumno;
                                $insmatricula->IdGrado =  (int)$mi_array->IdGrado;
                                $insmatricula->IdEstadoMatricula = 1;
                                $insmatricula->save();                                

                                return response()->json(['status'=>'success','message' => 'El registro del alumno se realizo correctamente']);                                        

                            }                                                     
                        }
                    }   
                }
            }
 
            }
        }catch (\Exception $e) {
            //Eliminar la matricula del alumno por si se presenta un poblema con los registros
            $delematricula = Matricula::where('IdAlumno','=', $Idalumnoglobl)->firstOrFail();
            $delematricula->delete();

            //Eliminar la información academica del alumno por si se presenta un poblema con los registros
            $deleteacademica = Academica::where('IdAlumno','=', $Idalumnoglobl)->firstOrFail();
            $deleteacademica->delete();

            $detalleacudiente = DetalleAlumnoAcudiente::where('IdAlumno','=', $Idalumnoglobl)->get();

            foreach ($detalleacudiente as $key => $value) {
                $deletedetalleacudiente =  DetalleAlumnoAcudiente::where('IdDetalleAlumnoAcudiente','=', $value['IdDetalleAlumnoAcudiente'])->firstOrFail();
                $deletedetalleacudiente->delete();
            }            

            $deletesalud = Salud::where('IdAlumno','=', $Idalumnoglobl)->firstOrFail();
            $deletesalud->delete();

            $deletealumno = Alumno::where('IdAlumno','=', $Idalumnoglobl)->firstOrFail();
            $deletealumno->delete();

            return response()->json(['status'=>'error','message' => 'Ha ocurrido un error con el proceso de registrar este alumno en el sistema. Actulice su navegador y vuelva a ingresarlo']);        
            /*return response()->json([$e->getMessage()]);  */
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
    //Consultar datos del alumno por el dato unico
       $alumnos = Alumno::findOrFail($id);                    
       $IdMun = $alumnos['IdMunicipioExpedido'];
    //Se envia la variable como parametro para hacer la consulta en la tabla municipio por medio del id
       $municip = Municipio::findOrFail($IdMun);                            
    //Enviar los array con los datos de alumno y departamento a la función ajax para asignarlos
       $depart1 = Departamento::where('IdDepartamento', '=', $municip['IdDepartamento'])->firstOrFail();       
    //Consultar ciudad para obtener el foreign key de ciudad para consultarlo
        $Idciud = $alumnos['IdCiudadNacimiento'];
       $ciudad = Municipio::findOrFail($Idciud);       
    //Consultar el departamento de esta ciudad para enviarlo a la vista por ajax
       $depart2 = Departamento::where('IdDepartamento', '=', $ciudad['IdDepartamento'])->firstOrFail();
    //Por comentar
       $Idciud1 = $alumnos['IdCiudadResidencia'];
    //Por comentar
       $ciudad1 = Municipio::findOrFail($Idciud1);       
    //Por comentar
       $depart3 = Departamento::where('IdDepartamento', '=', $ciudad['IdDepartamento'])->firstOrFail();              
    //Por comentar    
       $salud = Salud::where('IdAlumno','=', $alumnos['IdAlumno'])->firstOrFail();       
       
    //Municipio expulsor del alumno
       $municiexp = Municipio::where('IdMunicipio', '=', $salud['IdMunicipio'])->firstOrFail();              
    //Departamento expulsor        
       $departexp = Departamento::where('IdDepartamento', '=', $municiexp['IdDepartamento'])->firstOrFail();
    //Consultar en la tabla detalle que acudiente tiene asignados    
      $detalleacualum = DetalleAlumnoAcudiente::where('IdAlumno', '=', $alumnos['IdAlumno'])->firstOrFail();      
    //Datos del acudiente que pertenece al alumno
       $acudiente = Acudiente::where('IdAcudiente', '=', $detalleacualum['IdAcudiente'])->firstOrFail();
    //Consultar municipio de expedición del acudiente 
       $municiexpacu = Municipio::where('IdMunicipio', '=', $acudiente['IdMunicipioExpedicion'])->firstOrFail();
    //Consultar departamento de expedición del acudiente
       $departexpacu = Departamento::where('IdDepartamento', '=' , $municiexpacu['IdDepartamento'])->firstOrFail();
    //Datos de la información académica del alumno
        $academica = Academica::where('IdAlumno', '=', $alumnos['IdAlumno'])->firstOrFail();
    //Consultar aula en el que esta el alumno
        $aulas = Grupo::join('salones', 'grupos.IdSalon', '=', 'salones.IdSalon')                        
                        ->where('grupos.IdSalon','=',  $academica['IdGrado'])                         
                        ->select('salones.*')
                        ->getQuery()
                        ->get();
        

    return response()->json(['alumno' => $alumnos,'departamento'=>$depart1,
                            'departamento2'=>$depart2, 'departamento3'=>$depart3,
                            'salud'=>$salud, 'departamento4'=>$departexp, 'acudiente'=>$acudiente, 
                            'departamento5'=>$departexpacu, 'academica'=> $academica, 'aulas'=> $aulas, 'detallealumacu'=>$detalleacualum]);
       
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
        
        //validar los datos del alumno
        $alumno =  request()->validate([
            'PrimerNombre'=> 'required',            
            'PrimerApellido'=> 'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',
            'SegundoApellido'=> 'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',
            'Correo'=> 'required|unique:alumnos,Correo,'.$id.',IdAlumno,EstadoAlumno,'.true,
            'IdTipoDocumento'=> 'required',
            'NumeroDocumento'=> 'required|unique:alumnos,NumeroDocumento,'.$id.',IdAlumno,EstadoAlumno,'.true,
            'IdMunicipioExpedido'=> 'required', 
            'IdGenero'=> 'required',
            'FechaNacimiento'=> 'required', 
            'IdCiudadNacimiento'=> 'required', 
            'IdCiudadResidencia'=> 'required',
            'Direccion'=> 'required',
            'Zona'=> 'required',
            'Telefono'=> 'required',            
        ]);
        
        //validar los datos de la salud
        $salud = request()->validate([
            'IdEps'=> 'required|int',
            'IdTipoSangre'=> 'required',             
            'CarnetSisben'=> 'required', 
            'PuntajeSisben'=> 'required', 
            'Estrato'=> 'required' 
        ]);

        //validar los datos de el acudiente
        $acudiente = request()->validate([
            'PrimerNombreAcu'=> 'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',             
            'PrimerApellidoAcu'=> 'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/', 
            'SegundoApellidoAcu'=> 'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/', 
            'IdTipoDocumento'=> 'required', 
            'IdMunicipioExpedicion'=> 'required', 
            'IdParentesco'=> 'required', 
            'DireccionHogar'=> 'required',             
            'TelefonoCelular'=> 'required',             
            'NumeroDocumentoAcu'=> 'required', 
            'CorreoAcu'=> 'required'
        ]);

        //validar los datos de la información académica
        $academica = request()->validate([
            'IdGrado'=> 'required',             
            'Numerolista'=> 'required', 
            'Estado'=> 'required', 
            'FechaEstado'=> 'required', 
            'CodigoInterno'=> 'required', 
            'NumeroMatricula'=> 'required', 
            'InstitucionOrigen'=> 'required', 
            'EstadoAcademicoAnterior'=> 'required', 
            'EstadoMatriculaFinal'=> 'required'                     
        ]);
        
        //Consultar al aprendiz
        $ediAlum = Alumno::find($request['IdAlumno']);
        //Asignar los nuevos datos para el alumno
        $ediAlum->PrimerNombre = $request['PrimerNombre'];
        $ediAlum->SegundoNombre = $request['SegundoNombre'];
        $ediAlum->PrimerApellido = $request['PrimerApellido'];
        $ediAlum->SegundoApellido = $request['SegundoApellido'];
        $ediAlum->Correo = $request['Correo'];
        $ediAlum->IdTipoDocumento = $request['IdTipoDocumento'];
        $ediAlum->NumeroDocumento = $request['NumeroDocumento'];
        $ediAlum->IdMunicipioExpedido = $request['IdMunicipioExpedido'];
        $ediAlum->IdGenero = $request['IdGenero'];
        $ediAlum->FechaNacimiento = $request['FechaNacimiento'];
        $ediAlum->IdCiudadNacimiento = $request['IdCiudadNacimiento'];
        $ediAlum->IdCiudadResidencia = $request['IdCiudadResidencia'];
        $ediAlum->Direccion = $request['Direccion'];
        $ediAlum->Zona = $request['Zona'];
        $ediAlum->Telefono = $request['Telefono'];
        //Actualizar asignación en la BD
        $ediAlum->save();

        //Consultar datos de la salud del alumno
        $editSalud = Salud::where('IdAlumno', '=', $id)->first();
        
        //Ingresar los nuevs registros de saud del alumno
        $editSalud->IdEps = $request['IdEps'];
        $editSalud->IdTipoSangre = $request['IdTipoSangre'];
        $editSalud->Ips = $request['Ips'];
        $editSalud->Ars = $request['Ars'];
        $editSalud->CarnetSisben = $request['CarnetSisben'];
        $editSalud->PuntajeSisben = $request['PuntajeSisben'];
        $editSalud->Estrato = $request['Estrato'];
        $editSalud->FuenteRecursos = $request['FuenteRecursos'];
        $editSalud->MadreCabFamilia = $request['MadreCabFamilia'];
        $editSalud->HijoDeMadreCabFamilia = $request['HijoDeMadreCabFamilia'];
        $editSalud->BeneVeteranoMilitar = $request['BeneVeteranoMilitar'];
        $editSalud->BeneHeroeNacional = $request['BeneHeroeNacional'];
        $editSalud->IdVictima = $request['IdVictima'];
        $editSalud->FechaExpulsion = $request['FechaExpulsion'];
        $editSalud->IdMunicipio = $request['IdMunicipio'];
        $editSalud->IdResguardo = $request['IdResguardo'];
        $editSalud->IdEtnia = $request['IdEtnia'];
        //Actualizar registros en la bd
        $editSalud->save();

        //Consultar la información del acudiente del alumno
        $editAcudiente = Acudiente::join('detallealumnosacudientes', 'acudientes.IdAcudiente', '=', 'detallealumnosacudientes.IdAcudiente')
                                    ->where('detallealumnosacudientes.IdAlumno', '=', $id)
                                    ->select('acudientes.*')
                                    ->distinct()
                                    ->get(['detallealumnosacudientes.IdAlumno']);
                                    
        foreach ($editAcudiente as $key => $value) {            
            //Ingresar los nuevos registros del acudiente del alumno                                            
            $value->PrimerNombreAcu = $request['PrimerNombreAcu'];
            $value->SegundoNombreAcu = $request['SegundoNombreAcu'];
            $value->PrimerApellidoAcu = $request['PrimerApellidoAcu'];
            $value->SegundoApellidoAcu = $request['SegundoApellidoAcu'];
            $value->CorreoAcu = $request['CorreoAcu'];
            $value->IdParentesco = $request['IdParentesco'];
            $value->DireccionHogar = $request['DireccionHogar'];
            $value->TelefonoHogar = $request['TelefonoHogar'];
            $value->DireccionTrabajo = $request['DireccionTrabajo'];
            $value->TelefonoTrabajo = $request['TelefonoTrabajo'];
            $value->TelefonoCelular = $request['TelefonoCelular'];
            $value->Ocupacion = $request['Ocupacion'];
            $value->IdTipoDocumento = $request['IdTipoDocumento'];
            $value->NumeroDocumentoAcu = $request['NumeroDocumentoAcu'];
            $value->IdMunicipioExpedicion = $request['IdMunicipioExpedicion'];
            //Actualizar registros en la bd
            $value->save();
        }
        
        $editDetalleAlumAcu = DetalleAlumnoAcudiente::where('IdAlumno', $id)->firstOrFail();
        
        $editDetalleAlumAcu->IdTipoAcudiente = $request['IdTipoAcudiente'];
        $editDetalleAlumAcu->save();

        
        //Consultar la 
        $editAcademica = Academica::where('IdAlumno','=', $id)->first();
        //Ingresar los nuevos registros de la informacion academica del alumno
        $editAcademica->IdGrado = $request['IdGrado'];
        $editAcademica->valorPension = $request['valorPension'];
        $editAcademica->valorMatricula = $request['valorMatricula'];
        $editAcademica->Numerolista = $request['Numerolista'];
        $editAcademica->Estado = $request['Estado'];
        $editAcademica->FechaEstado = $request['FechaEstado'];
        $editAcademica->CodigoInterno = $request['CodigoInterno'];
        $editAcademica->NumeroMatricula = $request['NumeroMatricula'];
        $editAcademica->InstitucionOrigen = $request['InstitucionOrigen'];
        $editAcademica->EstadoAcademicoAnterior = $request['EstadoAcademicoAnterior'];
        $editAcademica->EstadoMatriculaFinal = $request['EstadoMatriculaFinal'];
        $editAcademica->CondicionFinAno = $request['CondicionFinAno'];
        $editAcademica->CausaTraslado = $request['CausaTraslado'];
        //Actualizar los nuevos registros de la información academica del alumno
        $editAcademica->save();


        return redirect()->route('alumno.index')->with('success','El registro de la matricula del alumno se registro con exito');
            
    }

    public function getCiudad(Request $request, $id)
    {
        if ($request->ajax()) {
        $ciudades = Ciudad::ciudades($id);
        return response()->json($ciudades);
        }
    }

    public function getMunicipio(Request $request, $id)
    {
        if ($request->ajax()) {
        $municipios = Municipio::municipios($id);
        return response()->json($municipios);
        }
    }


    public function destroy(Request $request, $id)
    {          

        if ($request->ajax()) {
            $alumno = Alumno::findOrFail($id);
            if ($alumno != null) {
                if ($alumno->EstadoAlumno == true) {
                    $alumno->EstadoAlumno = false;
                    $alumno->save();
                }else {
                    $alumno->EstadoAlumno = true;
                    $alumno->save();
                }
            }else {
                $alumno->EstadoAlumno = false;
                $alumno->save();
            }
            
            return response()->json([
                'message' => 'El alumno '. $alumno->PrimerNombre. ' '. $alumno->PrimerApellido. ' Ha sido eliminado exitosamente!'
            ]);
        }
    }
}
