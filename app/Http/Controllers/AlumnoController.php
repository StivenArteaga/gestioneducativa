<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
       $tipoacudiente = TipoAcudiente::all();

       $grados = Grado::where('EstadoGrado','=', true)->get();
       $salones = Salon::where('EstadoSalon','=', true)->get();
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        /*$usuario = new Usuario();

        $usuario->NombreUsuario=$request->get('NumeroDocumento');  
        $usuario->Contrasena = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';
        $usuario->TipoUsuario = 2;

        $usuario->id_autor=$autor->idautor;
        $libro->save();*/
        
        if ($request['IdAlumno'] != 0) {            
            $this->update($request, $request['IdAlumno']);            
            return redirect()->route('alumno.index')->with('success','La actualización de la matricula del alumno se registro con exito');
        } else {            
            
        $request->Usuaurio = 1;
        $request->IdUsuaurio = 1;
        

        $alumno =  request()->validate([
            'PrimerNombre'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
            'PrimerApellido'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u',
            'SegundoApellido'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u',
            'Correo'=> 'required',
            'IdTipoDocumento'=> 'required|int',
            'NumeroDocumento'=> 'required|max:12|regex:/^[0-9]+$/',
            'IdMunicipioExpedido'=> 'required|int', 
            'IdGenero'=> 'required|int',
            'FechaNacimiento'=> 'required', 
            'IdCiudadNacimiento'=> 'required|int', 
            'IdCiudadResidencia'=> 'required|int',
            'Direccion'=> 'required|max:60',
            'Zona'=> 'required',
            'Telefono'=> 'required|max:50',   
            'EstadoAlumno'=>'required|int'         
        ]);

        $existe = Alumno::where('NumeroDocumento', '=', $request['NumeroDocumento'])
                              ->where('EstadoAlumno', '=', true)
                              ->first();
                                                             
            if($existe != null){
                return redirect()->route('alumno.index')->with('errors','El documento de este alumno ya se encuentra registrado en el sistema');                                                                 
            }else{

                $existe1 = Alumno::where('Correo', '=', $request['Correo'])
                              ->where('EstadoAlumno', '=', true)
                              ->first();

                if($existe1 != null){
                    return redirect()->route('alumno.index')->with('errors','El documento de este alumno ya se encuentra registrado en el sistema');                                                                 
                }else{
                    $salud = request()->validate([
                        'IdEps'=> 'required|int',
                        'IdTipoSangre'=> 'required|int', 
                        'Ips'=> 'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
                        'Ars'=> 'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
                        'CarnetSisben'=> 'required|regex:/^[0-9]+$/', 
                        'PuntajeSisben'=> 'required|regex:/^[0-9-,]+$/', 
                        'Estrato'=> 'required|max:10|regex:/^[0-9]+$/'                    
                    ]);
                    
                    $acudiente = request()->validate([
                        'PrimerNombreAcu'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
                        'PrimerApellidoAcu'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u',
                        'SegundoApellidoAcu'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u',
                        'IdTipoDocumento'=> 'required|int', 
                        'IdMunicipioExpedicion'=> 'required|int', 
                        'IdParentesco'=> 'required|int', 
                        'TelefonoCelular'=> 'required|required|string|max:50',
                        'NumeroDocumentoAcu'=> 'required|max:12|regex:/^[0-9]+$/', 
                        'CorreoAcu'=> 'required',
                        'IdTipoAcudiente'=>'required|int'
                    ]);
            
                    $academica = request()->validate([
                        'IdGrado'=> 'required|int',             
                        'Numerolista'=> 'required', 
                        'Estado'=> 'required', 
                        'FechaEstado'=> 'required', 
                        'CodigoInterno'=> 'required', 
                        'NumeroMatricula'=> 'required', 
                        'InstitucionOrigen'=> 'required|max:100', 
                        'EstadoAcademicoAnterior'=> 'required|max:20', 
                        'EstadoMatriculaFinal'=> 'required|max:20'                               
                    ]);                
            
                    $matricula = request()->validate([
                        'IdAlumno',
                        'IdGrado',
                        'ValorMatricula',
                        'IdEstadoMatricula'
                    ]);        
                    
                    $request->flash();
                    
                    Alumno::create($request->all());
                    $IdAl = $request['NumeroDocumento'];
                    $gu = Alumno::where('NumeroDocumento', $IdAl)->firstOrFail();                           
                    $request['IdAlumno'] = $gu['IdAlumno'];                                                                               
            
                    
                    //Salud::create($request->all());        
                    $saludsave = new Salud();
                    $saludsave->IdEps = $request['IdEps'];
                    $saludsave->IdTipoSangre = $request['IdTipoSangre'];
                    $saludsave->Ips = $request['Ips'];
                    $saludsave->Ars = $request['Ars'];
                    $saludsave->CarnetSisben = $request['CarnetSisben'];
                    $saludsave->PuntajeSisben = $request['PuntajeSisben'];
                    $saludsave->Estrato = $request['Estrato'];
                    $saludsave->FuenteRecursos = $request['FuenteRecursos'];
                    $saludsave->MadreCabFamilia = $request['MadreCabFamilia'];
                    $saludsave->HijoDeMadreCabFamilia = $request['HijoDeMadreCabFamilia'];
                    $saludsave->BeneVeteranoMilitar = $request['BeneVeteranoMilitar'];
                    $saludsave->BeneHeroeNacional = $request['BeneHeroeNacional'];
                    $saludsave->IdVictima = $request['IdVictima'];
                    $saludsave->FechaExpulsion = $request['FechaExpulsion'];
                    $saludsave->IdMunicipio = $request['IdMunicipio'];
                    $saludsave->IdResguardo = $request['IdResguardo'];
                    $saludsave->IdEtnia = $request['IdEtnia'];
                    $saludsave->IdAlumno = $request['IdAlumno'];
                    $saludsave->save();

                    Acudiente::create($request->all());
                    Academica::create($request->all());
            
                    
                    $acudiente = Acudiente::all();
                    $IdAcudiente = $acudiente->last();
                    $request['IdAcudiente'] = $IdAcudiente['IdAcudiente'];
            
                    DetalleAlumnoAcudiente::create($request->all());
                    
                    if ($matricula != []) {
                        $request['valorMatricula'] = $matricula['valorMatricula'];
                    }
                    
                    $request['IdGrado'] = $academica['IdGrado'];
                    $request['IdEstadoMatricula'] = 1;
                    
                    Matricula::create($request->all());
                    
                    return redirect()->route('alumno.index')->with('success','El registro de la matricula del alumno se registro con exito');
                }                   
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
            'PrimerNombre'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
            'PrimerApellido'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u',
            'SegundoApellido'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u',
            'Correo'=> 'required|unique:alumnos,Correo,'.$id.',IdAlumno,EstadoAlumno,'.true,
            'IdTipoDocumento'=> 'required',
            'NumeroDocumento'=> 'required|max:12|regex:/^[0-9]+$/|unique:alumnos,NumeroDocumento,'.$id.',IdAlumno,EstadoAlumno,'.true,
            'IdMunicipioExpedido'=> 'required', 
            'IdGenero'=> 'required',
            'FechaNacimiento'=> 'required', 
            'IdCiudadNacimiento'=> 'required', 
            'IdCiudadResidencia'=> 'required',
            'Direccion'=> 'required|max:250', 
            'Zona'=> 'required',
            'Telefono'=> 'required|string|max:50'
        ]);

        //validar los datos de la salud
        $salud = request()->validate([
            'IdEps'=> 'required',
            'IdTipoSangre'=> 'required', 
            'Ips'=> 'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
            'Ars'=> 'required|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
            'CarnetSisben'=> 'required|regex:/^[0-9]+$/', 
            'PuntajeSisben'=> 'required|regex:/^[0-9-,]+$/', 
            'Estrato'=> 'required|max:10|regex:/^[0-9]+$/' 
        ]);

        //validar los datos de el acudiente
        $acudiente = request()->validate([
            'PrimerNombreAcu'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+$/',            
            'PrimerApellidoAcu'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u',
            'SegundoApellidoAcu'=> 'required|max:50|regex:/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/u',
            'IdTipoDocumento'=> 'required', 
            'IdMunicipioExpedicion'=> 'required', 
            'IdParentesco'=> 'required', 
            'TelefonoCelular'=> 'required|required|string|max:50',
            'NumeroDocumentoAcu'=> 'required|max:12|regex:/^[0-9]+$/', 
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
            'InstitucionOrigen'=> 'required|max:100', 
            'EstadoAcademicoAnterior'=> 'required|max:20', 
            'EstadoMatriculaFinal'=> 'required|max:20'
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

        $IdSaludvl = Salud::where('IdAlumno', '=', $id)->first();
        //Consultar datos de la salud del alumno
        $editSalud = Salud::find($IdSaludvl['IdSalud']);
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

        
        $academicavl = Academica::where('IdAlumno', '=', $id)->first();
        //Consultar la informacion academica del alumno
        $editAcademica = Academica::find($academicavl['IdInformacionAcademica']);
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


    public function destroy($id)
    {          
        $user = Alumno::findOrfail($id);
       if ($user != null) {
            if ($user->EstadoAlumno == true) {
                $user->EstadoAlumno = false;
                $user->save();
            }else {
                $user->EstadoAlumno = true;
                $user->save();
            }
       }else {
        $user->EstadoAlumno = false;
        $user->save();
       }
        return redirect()->route('alumno.index')->with('success','El alumno  fue eliminado con exito ');
    }
}
