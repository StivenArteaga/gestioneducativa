@extends('layouts.main')

@section('content')


@if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
    <p>{{ $message }}</p>
  </div>
@endif

@if ($message = Session::get('danger'))
  <div class="alert alert-danger alert-dismissable custom-success-box" style="margin: 15px;">
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
                     <a data-toggle="modal" data-target=".bd-example-modal-lg">Nuevo Grupo</a>
                  </button>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de grupos</h1>
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
                          <th>Aula</th>
                          <th>Grado</th>
                          <th>Jornada</th>
                          <th with="300px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($grupos as $grupo)
                            <tr>                                
                                <td>{{ $grupo->NombreSalon }}</td>
                                <td>{{ $grupo->NombreGrado }}</td>
                                <td>{{ $grupo->NombreJornada }}</td>
                                <td>                                       
                                  <button type="button" class="btn icon-table" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="MostrarGrupo({{$grupo->IdGrupo}})"><i class="far far fa-edit"></i></button>
                                {!! Form::open([ 'url'=>['grupo', $grupo->IdGrupo], 'method' => 'DELETE','style'=> 'display:inline' ]) !!}                                                            
                                  <button type="submit" class="btn icon-table"><i class="far fa-trash-alt icon-size"></i></a></button>
                                {!! Form::close() !!}               
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr> 
                          <th>Aula</th>
                          <th>Grado</th>
                          <th>Jornada</th>
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
                  <h2 class="card-title">Registro de grupos</h2>
                </div>
             <div class="card-content">
                <div class="card-body">   
                {!! Form::open(['route' => 'grupo.store', 'method' => 'POST']) !!}    
                    <form class="form form-horizontal row-separator">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-user"></i> Información de grupo</h4>
                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Tipo Calendario *</label>
                                  <div class="col-md-9">                                                        
                                    <select class="form-control m-bot15" id="IdTipoCalendario" name="IdTipoCalendario">
                                    @if($tipocalendarios->count())
                                      <option class="hidden">Selecciona una opción</option>
                                    @foreach($tipocalendarios as $tipocalendario)
                                      <option value="{{ $tipocalendario->IdTipoCalendario }}">{{ $tipocalendario->NombreCalendario }}</option>
                                    @endforeach
                                  @endif 
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Salon *</label>
                                  <div class="col-md-9">                                                        
                                    <select class="form-control m-bot15" id="IdSalon" name="IdSalon">
                                    @if($salones->count())
                                      <option class="hidden">Selecciona una opción</option>
                                    @foreach($salones as $salon)
                                      <option value="{{ $salon->IdSalon }}">{{ $salon->NombreSalon }}</option>
                                    @endforeach
                                  @endif
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Grado *</label>
                                  <div class="col-md-9">                                                        
                                    <select class="form-control m-bot15 target" id="IdGrado" onchange="listarAlum()" name="IdGrado">
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
                                <label class="col-md-3 label-control" for="projectinput6">Jornada *</label>
                                  <div class="col-md-9">                                                        
                                    <select class="form-control m-bot15" id="IdJornada" name="IdJornada">
                                    @if($jornadas->count())
                                      <option class="hidden">Selecciona una opción</option>
                                    @foreach($jornadas as $jornada)
                                      <option value="{{ $jornada->IdJornada }}">{{ $jornada->NombreJornada }}</option>
                                    @endforeach
                                  @endif
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Selección de alumnos *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#listaAlumnos" ><i class="far fa-eye"></i></button>                                            
                                                {!! Form::text('IdGrupo', null, ['id'=>'IdGrupo', 'class'=> 'hidden']) !!}                                                
                                                {!! Form::text('EstadoGrupo', 1, ['class'=>'hidden']) !!}
                                                {!! Form::text('FechaGrupo', null, ['class'=>'hidden']) !!}
                                            </div>
                                        </div>                                         
                                </div> 
                                <div id="data">
                                </div>    
                                <div id="data1">
                                </div>                                                            
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Selección de asignaturas *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">                                                                     
                                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#listaAsignaturas"><i class="far fa-eye"></i></button>
                                            </div>
                                        </div>                                         
                                </div>                
                            <div class="form-actions">
                                <a href="{{ route('logros') }}" class="btn btn-warning mr-1">
                                    <i class="la la-remove"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check"></i> Guardar
                                </button>
                            </div> 
                        </div>    
                    </form>                   
                {!! Form::close() !!} 
                </div>
            </div>
        </div>            

    </div>
  </div>
</div>







<div class="modal fade" id="listaAlumnos">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Listado de alumnos por grados *</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div class="card-content collapse show">
                  <div class="card-body card-dashboard">                    
                    <table class="table table-striped table-bordered dom-jQuery-events" id="MyTableAlumn">
                      <thead>
                        <tr>                                                
                          <th>Numero Documento</th>                          
                          <th>Nombre Completo</th>                   
                        </tr>
                      </thead>
                      <tbody id="IdTBodyListAlumn">                      
                                            
                      </tbody>
                      <tfoot>
                        <tr>                                                    
                          <th>Numero Documento</th>                          
                          <th>Nombre Completo</th>                   
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-primary" onclick="SelectAlum()" data-dismiss="modal">Agregar</button>-->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
</div>










<div class="modal fade" id="listaAsignaturas">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Listado de asignaturas *</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <div class="card-content collapse show">
                  <div class="card-body card-dashboard">                    
                    <table class="table table-striped table-bordered dom-jQuery-events" id="listaAsig">
                      <thead>
                        <tr>                      
                          <th>Asignatura</th>    
                          <th>Nombre Asignatura</th>                          
                          <th>Intencidad Horaria</th>
                        </tr>
                      </thead>
                      <tbody id="TAsign">                      
                      @foreach($asignaturas as $asignatura)
                            <tr>                                
                                <td class="hidden">{{ $asignatura->IdAsignatura }}</td>
                                <td><input type="checkbox" class="form-check-input" value="{{ $asignatura->IdAsignatura }}" name="checkAignatura" id="checkAignatura_{{$asignatura->IdAsignatura}}"></td>
                                <td>{{ $asignatura->NombreAsignatura }}</td>
                                <td>{{ $asignatura->Intensidad }}</td>                                
                            </tr>
                        @endforeach        
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Asignatura</th>    
                          <th>Nombre Asignatura</th>                          
                          <th>Intencidad Horaria</th>                 
                        </tr>
                      </tfoot>
                    </table>
                  </div>
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="SelectAsig1()" data-dismiss="modal">Agregar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div>

@endsection