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
                     <a data-toggle="modal" data-target=".bd-example-modal-lg">Nuevo Maestro</a>
                  </button>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de maestros</h1>
                  </div>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3" ></i></a>                  
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
                          <th with="50px">Nombre maestro</th>
                          <th>Apellido maestro</th>
                          <th>Numero documento</th>
                          <th>Asignatura</th>                          
                          <th with="">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($maestro as $maestros)
                            <tr>                                
                                <td>{{ $maestros->PrimerNombreMaes }}</td>
                                <td>{{ $maestros->PrimerApellidoMaes }}</td>
                                <td>{{ $maestros->NumeroDocumento }}</td>                                
                                <td>{{ $maestros->NombreAsignatura }}</td>
                                <td>                                       
                                  <button type="button" class="btn icon-table" data-toggle="modal" data-target=".bd-example-modal-lg" onclick='MostrarMaestro({{$maestros->IdMaestro}})'><i class="far far fa-edit"></i></button>
                                {!! Form::open([ 'url'=>['maestro', $maestros->IdMaestro], 'method' => 'DELETE','style'=> 'display:inline' ]) !!}                                                            
                                  <button type="submit" class="btn icon-table"><i class="far fa-trash-alt icon-size"></i></a></button>
                                {!! Form::close() !!}              
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Nombre maestro</th>
                          <th>Apellido maestro</th>
                          <th>Numero documento</th>                          
                          <th>Asignatura</th>    
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
                  <h2 class="card-title">Registro de maestro</h2>
                </div>
             <div class="card-content">
                <div class="card-body">   
                {!! Form::open(['route' => 'maestro.store', 'method' => 'POST']) !!}    
                <form class="form form-horizontal row-separator">
                      <div class="form-body">
                        <h4 class="form-section"><i class="la la-user"></i> Información personal</h4>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput6">Asignatura *</label>
                          <div class="col-md-9">                                                        
                            <select class="form-control m-bot15" id="IdAsignatura" name="IdAsignatura">
                              @if ($asignaturas->count())
                                    <option class="hidden">Selecciona una opción</option>
                                @foreach($asignaturas as $asignatura) 
                                    <option value="{{ $asignatura->IdAsignatura }}">{{ $asignatura->NombreAsignatura }}</option>
                                @endforeach
                              @endif
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">Primer nombre *</label>
                          <div class="col-md-9">
                            {!! Form::text('PrimerNombreMaes', null, ['id'=>'PNombreMaes','placeholder'=>'Ingrese su primer nombre', 'class'=> 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput1">Segundo nombre</label>
                          <div class="col-md-9">                            
                            {!! Form::text('SegundoNombreMaes', null, ['id'=>'SNombreMaes','placeholder'=>'Ingrese su segundo nombre', 'class'=> 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput2">Primer apellido *</label>
                          <div class="col-md-9">                            
                            {!! Form::text('PrimerApellidoMaes', null, ['id'=>'PApellidoMaes','placeholder'=>'Ingrese su primer apellido', 'class'=> 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput2">Segundo apellido *</label>
                          <div class="col-md-9">                            
                            {!! Form::text('SegundoApellidoMaes', null, ['id'=>'SApellidoMaes','placeholder'=>'Ingrese su segundo apellido', 'class'=> 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput6">Tipo documento *</label>
                          <div class="col-md-9">                                                        
                            <select class="form-control m-bot15" id="IdTipoDocumentoMaes" name="IdTipoDocumento">
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
                            {!! Form::text('NumeroDocumento', null, ['id'=>'NumeDocumenMaes', 'placeholder'=>'Ingrese su numero de documento', 'class'=> 'form-control']) !!}
                            {!! Form::text('IdMaestro', null, ['id'=>'IdMaestro', 'class'=>'hidden']) !!}
                            {!! Form::text('EstadoMaestro', 1, ['class'=>'hidden']) !!}
                          </div>                          
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="timesheetinput3">Fecha de nacimiento *</label>
                          <div class="col-md-9">
                            <div class="position-relative has-icon-left">                            
                              {!! Form::date('FechaNacimiento', null, ['id'=>'FechaNaciMaes','placeholder'=>'01/01/2011', 'class'=> 'form-control']) !!}
                              <div class="form-control-position">
                                <i class="la la-calendar"></i>
                              </div>
                            </div>
                          </div>
                        </div>                        
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput6">Genero *</label>
                          <div class="col-md-9">                                                        
                            <select class="form-control m-bot15" id="IdGeneroMaes" name="IdGenero">
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
                          <label class="col-md-3 label-control" for="projectinput6">Tipo de sangre *</label>
                          <div class="col-md-9">                                                        
                            <select class="form-control m-bot15" id="IdTipoSangMaes" name="IdTipoSangre">
                              @if ($sangres->count())
                                <option class="hidden">Selecciona una opción</option>
                                @foreach($sangres as $sangre)
                                    <option value="{{ $sangre->IdTipoSangre }}">{{ $sangre->NombreTipoSangre }}</option>
                                @endforeach
                              @endif
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput3">E-mail *</label>
                          <div class="col-md-9">                            
                            {!! Form::email('Correo', null, ['id'=>'CorreoMaes','placeholder'=>'example@example.com', 'class'=> 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row last">
                          <label class="col-md-3 label-control" for="projectinput9">Dirección *</label>
                          <div class="col-md-9">                            
                            {!! Form::textarea('Direccion', null, ['id'=>'DireccionMaes','placeholder'=>'Ingrese la dirección de su residencia', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                          </div>
                        </div>                        
                        <div class="form-group row last">
                          <label class="col-md-3 label-control" for="projectinput4">Numero de contacto *</label>
                          <div class="col-md-9">                            
                            {!! Form::text('Telefono', null, ['id'=>'NumerContactMaes','placeholder'=>'Ingrese su numero de telefono', 'class'=> 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput6">Ciudad origen *</label>
                          <div class="col-md-9">                                                        
                            <select class="form-control m-bot15" id="IdCiudadOrigMaes" name="IdCiudad">
                              @if ($ciudades->count())
                                <option class="hidden">Selecciona una opción</option>
                                @foreach($ciudades as $ciudad)
                                    <option value="{{ $ciudad->IdCiudad }}">{{ $ciudad->NombreCiudad }}</option>
                                @endforeach
                              @endif
                            </select>
                          </div>
                        </div>
                        <div class="form-group row last">
                          <label class="col-md-3 label-control" for="projectinput4">Especialización *</label>
                          <div class="col-md-9">                            
                            {!! Form::text('Especializacion', null, ['id'=>'EspeciaMaes','placeholder'=>'Ingrese la su especialización', 'class'=> 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row last">
                          <label class="col-md-3 label-control" for="projectinput4">Escalafon *</label>
                          <div class="col-md-9">                            
                            {!! Form::text('Escalafon', null, ['id'=>'EscalafonMaes','placeholder'=>'Ingrese su escalafon', 'class'=> 'form-control']) !!}
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput6">Es coordinador *</label>
                          <div class="col-md-9">                                                        
                            <select class="form-control m-bot15"id="CoordinadorMaes" name="Coordinador">                              
                                <option class="hidden">Selecciona una opción</option>                                
                                <option value="Si">Si</option>                                                            
                                <option value="No">No</option>
                            </select>
                          </div>
                        </div>

                      </div>
                      <div class="form-actions">
                        <a href="{{ route('maestros') }}" class="btn btn-warning mr-1">
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

@endsection