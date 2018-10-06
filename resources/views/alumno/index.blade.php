@extends('layouts.main')

@section('content')

@if ($message = Session::get('success'))
  <div class="alert alert-success">
    <p>{{ $message }}</p>
  </div>
@endif


@if(count($errors) > 0)
    <div class="alert alerrt">  
        <strong>Whoooops!!</strong> ha ocurrido un error con tu registro.<br>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

<section id="dom">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <button class="btn btn-success">
                     <a data-toggle="modal" data-target=".bd-example-modal-lg" onclick="AsignaNumerAuto()">Nuevo alumno</a>
                  </button>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de alumnos</h1>
                  </div>
                  <a class="heading-elements-toggle" title="Registrar nuevo alumno"><i class="la la-ellipsis-v font-medium-3" ></i></a>                  
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>                      
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">                    
                    <table class="table table-striped table-bordered dom-jQuery-events">
                      <thead>
                        <tr>                          
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Documento</th>
                          <th>Telefono</th>
                          <th>E-Mail</th>
                          <th with="300px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($alumnos as $alumno)
                            <tr>                                
                                <td>{{ $alumno->PrimerNombre }}</td>
                                <td>{{ $alumno->PrimerApellido }}</td>
                                <td>{{ $alumno->NumeroDocumento }}</td>
                                <td>{{ $alumno->Telefono }}</td>
                                <td>{{ $alumno->Correo }}</td>
                                <td>                                       
                                <button type="button" class="btn icon-table" data-toggle="modal" data-target=".bd-example-modal-lg" onclick='Mostrar({{$alumno->IdAlumno}})'><i class="far far fa-edit"></i></button>                                                                                                    
                                {!! Form::open([ 'url'=>['alumno', $alumno->IdAlumno], 'method' => 'DELETE','style'=> 'display:inline' ]) !!}                                                            
                                <button type="submit" class="btn icon-table" ><i class="far fa-trash-alt icon-size"></i></a></button>
                                {!! Form::close() !!}              
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Documento</th>
                          <th>Telefono</th>
                          <th>E-Mail</th>
                          <th>Acción</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
</section>



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      
              <div class="card">
                <div class="card-header">
                  <h2 class="card-title">Registro de alumno</h2>
                </div>
                <div class="card-content">
                  <div class="card-body">                    
                    <ul class="nav nav-tabs nav-linetriangle no-hover-bg nav-justified">
                      <li class="nav-item">
                        <a class="nav-link active" id="active-tab3" data-toggle="tab" href="#active3" aria-controls="active3" aria-expanded="true">Datos alumno</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="link-tab3" data-toggle="tab" href="#link3" aria-controls="link3" aria-expanded="false">Datos salud</a>
                      </li>                      
                      <li class="nav-item">
                        <a class="nav-link" id="linkOpt-tab3" data-toggle="tab" href="#linkOpt3" aria-controls="linkOpt3">Datos acudiente</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="linkOpt-tab4" data-toggle="tab" href="#linkOpt4" aria-controls="linkOpt4">Datos académicos</a>
                      </li>
                    </ul>
                    <div class="tab-content px-1 pt-1">
                    

                      <div role="tabpanel" class="tab-pane active" id="active3" aria-labelledby="active-tab3" aria-expanded="true">
                        {!! Form::open(['route' => 'alumno.store', 'method' => 'POST']) !!}    
                        <form class="form form-horizontal row-separator">
                              <div class="form-body">
                              <h4 class="form-section"><i class="la la-user"></i> Información personal</h4>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Primer nombre *</label>
                                <div class="col-md-9">
                                <input type="text" class="hidden">
                                {!! Form::text('PrimerNombre', null, ['id'=>'PNombreA', 'placeholder'=>'Ingrese su primer nombre', 'class'=> 'form-control']) !!}
                                {!! Form::text('Usuario', 1, ['placeholder'=>'Ingrese su primer nombre', 'class'=> 'form-control hidden']) !!}
                                {!! Form::text('IdUsuario', 1, ['placeholder'=>'Ingrese su primer nombre', 'class'=> 'form-control hidden']) !!}
                                {!! Form::text('EstadoAlumno', true, ['placeholder'=>'Ingrese su primer nombre', 'class'=> 'form-control hidden']) !!}                              
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Segundo nombre</label>
                                <div class="col-md-9">                            
                                  {!! Form::text('SegundoNombre', null, ['id'=>'SNombreAlum','placeholder'=>'Ingrese su segundo nombre', 'class'=> 'form-control']) !!}
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput2">Primer apellido *</label>
                                <div class="col-md-9">                            
                                  {!! Form::text('PrimerApellido', null, ['id'=>'PApellidoAlum', 'placeholder'=>'Ingrese su primer apellido', 'class'=> 'form-control']) !!}
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput2">Segundo apellido *</label>
                                <div class="col-md-9">                            
                                  {!! Form::text('SegundoApellido', null, ['id'=>'SApellidoAlum','placeholder'=>'Ingrese su segundo apellido', 'class'=> 'form-control']) !!}
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput3">E-mail *</label>
                                <div class="col-md-9">                            
                                  {!! Form::email('Correo', null, ['id'=>'CorreoAlum','placeholder'=>'example@example.com', 'class'=> 'form-control']) !!}
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Tipo documento *</label>
                                <div class="col-md-9">                                                        
                                  <select class="form-control m-bot15" id="TipoDocumenAlum" name="IdTipoDocumento">
                                  @if($tipodocumentos->count())
                                          <option class="hidden">Selecciona una opción</option>
                                      @foreach($tipodocumentos as $tipodocumento)
                                          <option value="{{ $tipodocumento->IdTipoDocumento }}">{{ $tipodocumento->NombreTipoDocumento }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput4">Numero de documento *</label>
                                <div class="col-md-9">                            
                                  {!! Form::text('NumeroDocumento', null, ['id'=>'NDocumentAlum','placeholder'=>'Ingrese su numero de documento', 'class'=> 'form-control']) !!}
                                </div>                          
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Departamento expedición</label>
                                <div class="col-md-9">                                                        
                                  <select class="form-control m-bot15" id="DeparExpAlum" name="IdDepartamento">
                                  @if ($departamentos->count())
                                          <option class="hidden">Selecciona una opción</option>
                                      @foreach($departamentos as $departamento)
                                          <option value="{{ $departamento->IdDepartamento }}">{{ $departamento->NombreDepartamento }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Municipio expedición</label>
                                <div class="col-md-9">                                                        
                                  <select class="form-control m-bot15"  id="IdMunicipioExpedido" name="IdMunicipioExpedido">
                                  @if ($municipios->count())
                                          <option class="hidden">Selecciona una opción</option>
                                      @foreach($municipios as $municipio)
                                          <option value="{{ $municipio->IdMunicipio }}">{{ $municipio->NombreMunicipio }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Genero *</label>
                                <div class="col-md-9">                                                        
                                  <select class="form-control m-bot15" id="GenerAlum" name="IdGenero">
                                  @if ($generos->count())
                                          <option class="hidden">Selecciona una opción</option>
                                      @foreach($generos as $genero)
                                          <option value="{{ $genero->IdGenero }}">{{ $genero->NombreGenero }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                </div>
                              </div>                        
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="timesheetinput3">Fecha de nacimiento *</label>
                                <div class="col-md-9">
                                  <div class="position-relative has-icon-left">                            
                                    {!! Form::date('FechaNacimiento', null, ['id'=>'FechaNacAlum','placeholder'=>'01/01/2011', 'class'=> 'form-control']) !!}
                                    <div class="form-control-position">
                                      <i class="la la-calendar"></i>
                                    </div>
                                  </div>
                                </div>
                              </div>          
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Departamento nacimiento</label>
                                <div class="col-md-9">                                                        
                                  <select class="form-control m-bot15" id="DeparNacAlum" name="IdDepartamento">
                                  @if ($departamentos->count())
                                          <option class="hidden">Selecciona una opción</option>
                                      @foreach($departamentos as $departamento)
                                          <option value="{{ $departamento->IdDepartamento }}">{{ $departamento->NombreDepartamento }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Ciudad nacimiento</label>
                                <div class="col-md-9">                                                        
                                  <select class="form-control m-bot15" id="CiudNaciAlum" name="IdCiudadNacimiento">
                                  @if ($ciudades->count())
                                          <option class="hidden">Selecciona una opción</option>
                                      @foreach($ciudades as $ciudade)
                                          <option value="{{ $ciudade->IdCiudad }}">{{ $ciudade->NombreCiudad }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row last">
                                <label class="col-md-3 label-control" for="projectinput9">Dirección *</label>
                                <div class="col-md-9">                            
                                  {!! Form::textarea('Direccion', null, ['id'=>'DirecAlum','placeholder'=>'Ingrese la dirección de su residencia', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                                </div>
                              </div>     
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Zona *</label>
                                <div class="col-md-9">                                                        
                                  <select class="form-control m-bot15" id="ZonaAlum" name="Zona">                                
                                      <option class="hidden">Selecciona una opción</option>
                                      <option value="1">Rural</option>                                                                            
                                      <option vlue="2">Urbana</option>
                                  </select>
                                </div>
                              </div>                                           
                              <div class="form-group row last">
                                <label class="col-md-3 label-control" for="projectinput4">Numero de contacto *</label>
                                <div class="col-md-9">                            
                                  {!! Form::text('Telefono', null, ['id'=>'NumContatAlum','placeholder'=>'Ingrese su numero de telefono', 'class'=> 'form-control']) !!}
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Departamento residencia</label>
                                <div class="col-md-9">                                                        
                                  <select class="form-control m-bot15" id="DeparResidAlum" name="IdDepartamento">
                                  @if ($departamentos->count())
                                          <option class="hidden">Selecciona una opción</option>
                                      @foreach($departamentos as $departamento)
                                          <option value="{{ $departamento->IdDepartamento }}">{{ $departamento->NombreDepartamento }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Ciudad residencia</label>
                                <div class="col-md-9">                                                        
                                  <select class="form-control m-bot15" id="CiudResAlum" name="IdCiudadResidencia">
                                  @if ($ciudades->count())
                                          <option class="hidden">Selecciona una opción</option>
                                      @foreach($ciudades as $ciudade)
                                          <option value="{{ $ciudade->IdCiudad }}">{{ $ciudade->NombreCiudad }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                </div>
                              </div>                        
                              </div>                            
                          
                      </div>  

                      <div class="tab-pane" id="link3" role="tabpanel" aria-labelledby="link-tab3" aria-expanded="false">
                        
                          <div class="form-body">
                            <h4 class="form-section"><i class="la la-user"></i> Información salud</h4>                            
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Eps</label>
                                  <div class="col-md-9">                                                        
                                    <select class="form-control m-bot15" id="IdEps" name="IdEps">
                                    @if($eps->count())
                                      <option class="hidden">Selecciona una opción</option>
                                    @foreach($eps as $eps)
                                      <option value="{{ $eps->IdEps }}">{{ $eps->NombreEps }}</option>
                                    @endforeach
                                  @endif
                                    </select>
                                  </div>
                                </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Ips *</label>
                              <div class="col-md-9">
                              {!! Form::text('Ips', null, ['id'=>'IpsAlum', 'placeholder'=>'Ingrese su ips', 'class'=> 'form-control']) !!}
                              {!! Form::text('IdAlumno', null, ['id'=>'IdAlumno','class'=> 'hidden']) !!}                              
                              {!! Form::text('EstadoAlumno', 1, ['class'=>'hidden']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Tipo sangre *</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="IdTipoSangreAlum" name="IdTipoSangre">
                                @if($tiposangres->count())
                                        <option class="hidden">Selecciona una opción</option>
                                    @foreach($tiposangres as $tiposangre)
                                        <option value="{{ $tiposangre->IdTipoSangre }}">{{ $tiposangre->NombreTipoSangre }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Ars *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('Ars', null, ['id'=>'ArsAlum','placeholder'=>'Ingrese su ars', 'class'=> 'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput2">Numero carnet sisben *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('CarnetSisben', null, ['id'=>'NumCarnetAlum','placeholder'=>'Ingrese el numero de su carnet del sisben', 'class'=> 'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput2">Puntaje sisben *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('PuntajeSisben', null, ['id'=>'PunSisAlum','placeholder'=>'Ingrese el puntaje de sus sisben', 'class'=> 'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput3">Estrato *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('Estrato', null, ['id'=>'EstraroAlum','placeholder'=>'Ingrese en numero de su estrato', 'class'=> 'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Fuente de recursos (opcional)</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="FuenteRecursosAlum" name="FuenteRecursos">                                
                                    <option class="hidden">Selecciona una opción</option>                                
                                    <option value="FNR">Fnr</option>
                                    <option value="No aplica">No aplica</option>
                                    <option value="No Recursos propios">Recursos propios</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Madre cabeza de familia (opcional)</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="MadreCabFamiliaAlum" name="MadreCabFamilia">                                
                                    <option class="hidden">Selecciona una opción</option>                                
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>                                    
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Hijo de cabeza de familia (opcional)</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="HijoDeMadreCabFamiliaAlum" name="HijoDeMadreCabFamilia">                                
                                    <option class="hidden">Selecciona una opción</option>                                
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>                                    
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Beneficiario de veterano militar (opcional)</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="BeneVeteranoMilitarAlum" name="BeneVeteranoMilitar">                                
                                    <option class="hidden">Selecciona una opción</option>                                
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>                                    
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Beneficiario de heroe nacional (opcional)</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="BeneHeroeNacionalAlum" name="BeneHeroeNacional">                                
                                    <option class="hidden">Selecciona una opción</option>                                
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>                                    
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Población victima (opcional)</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="IdVictimaAlum" name="IdVictima">
                                @if($tipovictimas->count())
                                        
                                    @foreach($tipovictimas as $tipovictima)
                                        <option value="{{ $tipovictima->IdVictima }}">{{ $tipovictima->NombreTipoVictima }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="timesheetinput3">Fecha de expulsión (opcional)</label>
                              <div class="col-md-9">
                                <div class="position-relative has-icon-left">                            
                                  {!! Form::date('FechaExpulsion', null, ['id'=>'FechaExpulAlum','placeholder'=>'01/01/2011', 'class'=> 'form-control']) !!}
                                  <div class="form-control-position">
                                    <i class="la la-calendar"></i>
                                  </div>
                                </div>
                              </div>
                            </div>       
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Departameno expulsor (opcional)</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="IdDepartamentoExpAlum" name="IdDepartamento">
                                @if($departamentos->count())
                                        
                                    @foreach($departamentos as $departamento)
                                        <option value="{{ $departamento->IdDepartamento }}">{{ $departamento->NombreDepartamento }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Municipio expulsor (opcional)</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="IdMunicipioExpAlum" name="IdMunicipio">
                                @if($municipios->count())
                                        
                                    @foreach($municipios as $municipio)
                                        <option value="{{ $municipio->IdMunicipio }}">{{ $municipio->NombreMunicipio }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Resguardo (opcional)</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="IdResguardoAlum" name="IdResguardo">
                                @if($resguardos->count())
                                        
                                    @foreach($resguardos as $resguardo)
                                        <option value="{{ $resguardo->IdResguardos }}">{{ $resguardo->NombreResguardo }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Etnia (opcional)</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15"id="IdEtniaAlum" name="IdEtnia">
                                @if($etnias->count())
                                        
                                    @foreach($etnias as $etnia)
                                        <option value="{{ $etnia->IdEtnias }}">{{ $etnia->NombreEtnia }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>
                                   
                            </div>
                                                    
                      </div>
  
                      <div class="tab-pane" id="linkOpt3" role="tabpanel" aria-labelledby="linkOpt-tab3"aria-expanded="false">
                         
                            <div class="form-body">
                            <h4 class="form-section"><i class="la la-user"></i> Información acudiente</h4>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Tipo Acudiente *</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="IdTipoAcudiente" name="IdTipoAcudiente">
                                @if($tipoacudiente->count())
                                        <option class="hidden">Selecciona una opción</option>
                                    @foreach($tipoacudiente as $tipoacudientes)
                                        <option value="{{ $tipoacudientes->IdTipoAcudiente }}">{{ $tipoacudientes->NombreTipoAcudiente }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Primer nombre *</label>
                              <div class="col-md-9">
                              {!! Form::text('PrimerNombreAcu', null, ['id'=>'PrimNombAcu','placeholder'=>'Ingrese su primer nombre', 'class'=> 'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Segundo nombre</label>
                              <div class="col-md-9">                            
                                {!! Form::text('SegundoNombreAcu', null, ['id'=>'SeguNombAcu','placeholder'=>'Ingrese su segundo nombre', 'class'=> 'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput2">Primer apellido *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('PrimerApellidoAcu', null, ['id'=>'PriApellAcu','placeholder'=>'Ingrese su primer apellido', 'class'=> 'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput2">Segundo apellido *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('SegundoApellidoAcu', null, ['id'=>'SeguApellAcu','placeholder'=>'Ingrese su segundo apellido', 'class'=> 'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput3">E-mail *</label>
                              <div class="col-md-9">                            
                                {!! Form::email('CorreoAcu', null, ['id'=>'EmailAcu','placeholder'=>'example@example.com', 'class'=> 'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Parentesco *</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="IdParentescoAcu" name="IdParentesco">
                                @if($parentescos->count())
                                        <option class="hidden">Selecciona una opción</option>
                                    @foreach($parentescos as $parentesco)
                                        <option value="{{ $parentesco->IdParentesco }}">{{ $parentesco->NombreTipoParentesco }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>
                            <div class="form-group row last">
                              <label class="col-md-3 label-control" for="projectinput9">Dirección hogar *</label>
                              <div class="col-md-9">                            
                                {!! Form::textarea('DireccionHogar', null, ['id'=>'DirHogAcu','placeholder'=>'Ingrese la dirección de su residencia', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Telefono hogar (opcional)</label>
                              <div class="col-md-9">                            
                                {!! Form::text('TelefonoHogar', null, ['id'=>'TelHogAcu', 'placeholder'=>'Ingrese su numero de telefono del hogar', 'class'=> 'form-control']) !!}
                              </div>                          
                            </div>
                            <div class="form-group row last">
                              <label class="col-md-3 label-control" for="projectinput9">Dirección trabajo (opcional)</label>
                              <div class="col-md-9">                            
                                {!! Form::textarea('DireccionTrabajo', null, ['id'=>'DirTraAcu','placeholder'=>'Ingrese la dirección de su trabajo', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Telefono trabajo (opcional)</label>
                              <div class="col-md-9">                            
                                {!! Form::text('TelefonoTrabajo', null, ['id'=>'TelTraAcu','placeholder'=>'Ingrese su numero de telefono del trabajo', 'class'=> 'form-control']) !!}
                              </div>                          
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Telefono personal *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('TelefonoCelular', null, ['id'=>'TelPerAcu','placeholder'=>'Ingrese su numero de telefono de celular', 'class'=> 'form-control']) !!}
                              </div>                          
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Ocupación (opcional)</label>
                              <div class="col-md-9">                            
                                {!! Form::text('Ocupacion', null, ['id'=>'OcupAcu','placeholder'=>'Ingrese su ocupación laboral', 'class'=> 'form-control']) !!}
                              </div>                          
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Tipo documento *</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="IdTipoDocumentoAcu" name="IdTipoDocumento">
                                @if ($tipodocumentos->count())
                                        <option class="hidden">Selecciona una opción</option>
                                    @foreach($tipodocumentos as $tipodocumento)
                                        <option value="{{ $tipodocumento->IdTipoDocumento }}">{{ $tipodocumento->NombreTipoDocumento }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Numero de documento *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('NumeroDocumentoAcu', null, ['id'=>'NumDocuAcu','placeholder'=>'Ingrese su numero de documento', 'class'=> 'form-control']) !!}
                              </div>                          
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Departamento expedición</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="IdDepartamentoExpAcu" name="IdDepartamento">
                                @if ($departamentos->count())
                                        <option class="hidden">Selecciona una opción</option>
                                    @foreach($departamentos as $departamento)
                                        <option value="{{ $departamento->IdDepartamento }}">{{ $departamento->NombreDepartamento }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Municipio expedición</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="IdMunicipioExpedicionAcu" name="IdMunicipioExpedicion">
                                @if ($municipios->count())
                                        <option class="hidden">Selecciona una opción</option>
                                    @foreach($municipios as $municipio)
                                        <option value="{{ $municipio->IdMunicipio }}">{{ $municipio->NombreMunicipio }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>

                                                  
                            </div>
                            
                          
                      </div>


                      <div class="tab-pane" id="linkOpt4" role="tabpanel" aria-labelledby="linkOpt-tab4" aria-expanded="false">                        
                            <div class="form-body">
                            <h4 class="form-section"><i class="la la-user"></i> Información académica</h4>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Grado *</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="IdGradoIfAca" name="IdGrado">
                                @if($grados->count())
                                        <option class="hidden">Selecciona una opción</option>
                                    @foreach($grados as $grado)
                                        <option value="{{ $grado->IdGrado }}">{{ $grado->NombreGrado }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                            </div>                            
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Valor pension (opcional)</label>
                              <div class="col-md-9">
                              {!! Form::text('valorPension', null, ['id'=>'ValPensIfAca','placeholder'=>'Ingrese el valor de la pensión', 'class'=> 'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput1">Valor matrícula (opcional)</label>
                              <div class="col-md-9">                            
                                {!! Form::text('valorMatricula', null, ['id'=>'valorMatricula','placeholder'=>'Ingrese el valor de la matrícula', 'class'=> 'form-control']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput2">Numero de lista actual *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('Numerolista', null, ['id'=>'NumLisAca','placeholder'=>'Ingrese el numero de lista actual', 'class'=> 'form-control', 'readonly']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput6">Estado *</label>
                              <div class="col-md-9">                                                        
                                <select class="form-control m-bot15" id="EstadoAca" name="Estado">                                
                                    <option class="hidden">Selecciona una opción</option>                                    
                                    <option value="ACTIVO">ACTIVO</option>  
                                    <option value="RETIRADO">RETIRADO</option>  
                                    <option value="TRASLADADO">TRASLADADO</option>  
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="timesheetinput3">Fecha de estado *</label>
                              <div class="col-md-9">
                                <div class="position-relative has-icon-left">                            
                                  {!! Form::date('FechaEstado', null, ['id'=>'FechEstaAca','placeholder'=>'01/01/2011', 'class'=> 'form-control']) !!}
                                  <div class="form-control-position">
                                    <i class="la la-calendar"></i>
                                  </div>
                                </div>
                              </div>
                            </div> 
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput2">Código interno *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('CodigoInterno', null, ['id'=>'CodigAca','placeholder'=>'Ingrese su codigo', 'class'=> 'form-control', 'readonly']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput3">Número matrícula *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('NumeroMatricula', null, ['id'=>'NumMatrAca','placeholder'=>'Ingrese el numero de su matrícula', 'class'=> 'form-control', 'readonly']) !!}
                              </div>
                            </div>
                            
                            <div class="form-group row last">
                              <label class="col-md-3 label-control" for="projectinput9">Institución de origen *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('InstitucionOrigen', null, ['id'=>'InstOrigAca','placeholder'=>'Ingrese el nombre de su anterior institución', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Estado academico anterior *</label>
                              <div class="col-md-9">                            
                                  {!! Form::text('EstadoAcademicoAnterior', null, ['id'=>'EstaAcaAnte','placeholder'=>'Ingrese su estado academico anterior', 'class'=> 'form-control']) !!}
                              </div>                          
                            </div>
                            <div class="form-group row last">
                              <label class="col-md-3 label-control" for="projectinput9">Estado matricula final *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('EstadoMatriculaFinal', null, ['id'=>'EstaMatrFinAca','placeholder'=>'Ingrese su estado de matrícula final', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Condición fin de año (opcional)</label>
                              <div class="col-md-9">                            
                                {!! Form::text('CondicionFinAno', null, ['id'=>'CondiFinAnoAca','placeholder'=>'Ingrese su condición', 'class'=> 'form-control']) !!}
                              </div>                          
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Causa traslado (opcional)</label>
                              <div class="col-md-9">                            
                                {!! Form::text('CausaTraslado', null, ['id'=>'CausTrasAca','placeholder'=>'Ingrese su motivo de traslado', 'class'=> 'form-control']) !!}
                              </div>                          
                            </div>                
                        </div>    
                        </div>   
                        <div class="form-actions">
                        <a href="{{ route('alumno') }}" class="btn btn-warning mr-1">
                          <i class="la la-remove"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                          <i class="la la-check"></i> Guardar
                        </button>
                      </div>                      
                      </form>                        

                      {!! Form::close() !!}
                      </div>

                  </div>
                </div>
              </div>
            

    </div>
  </div>
</div>

@endsection