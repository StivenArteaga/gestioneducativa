@extends('layouts.main')

@section('content')


@if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
    <p>{{ $message }}</p>
  </div>
@endif

@if ($message = Session::get('error'))
  <div class="alert alert-danger alert-dismissable custom-success-box" style="margin: 15px;">
    <p>{{ $message }}</p>
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger alert-dismissable custom-success-box" style="margin: 15px;">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


<section id="dom">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <button class="btn btn-success">
                     <a data-toggle="modal" data-target=".bd-example-modal-lg">Nueva Asignatura</a>
                  </button>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de asignaturas</h1>
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
                          <th>Asignatura</th>      
                          <th>Materia</th>    
                          <th>Tipo asignatura</th>                                                                       
                          <th with="300px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($asignaturas as $asignatura)
                            <tr>                    
                                <td>{{ $asignatura->NombreAsignatura }}</td>                                            
                                <td>{{ $asignatura->NombreMateria }}</td>
                                <td>{{ $asignatura->NombreTipoAsignatura }}</td>                                 
                                <td>                                       
                                <button type="button" class="btn icon-table" data-toggle="modal" data-target=".bd-example-modal-lg" onclick='MostrarAsignatura({{$asignatura->IdAsignatura}})'><i class="far far fa-edit"></i></button>
                                {!! Form::open([ 'url'=>['asignatura', $asignatura->IdAsignatura], 'method' => 'DELETE','style'=> 'display:inline' ]) !!}                                                            
                                  <button type="submit" class="btn icon-table"><i class="far fa-trash-alt icon-size"></i></a></button>
                                {!! Form::close() !!}   
                                <button type="button" class="btn icon-table" data-toggle="modal" data-target="#asignaturasLogro" onclick="DetalleAsignatura({{$asignatura->IdAsignatura}})"><i class="fas fa-align-justify"></i></button>           
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>                  
                          <th>Asignatura</th>      
                          <th>Materia</th>    
                          <th>Tipo asignatura</th>                                                                        
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
                  <h2 class="card-title">REGISTRO ASIGNATURAS</h2>
                </div>
             <div class="card-content">
                <div class="card-body">   
                {!! Form::open(['route' => 'asignatura.store', 'method' => 'POST']) !!}    
                    <form class="form form-horizontal row-separator">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-user"></i> Información de asignatura</h4>  
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Nombre asignatura *</label>
                              <div class="col-md-9">                            
                                {!! Form::text('NombreAsignatura', null, ['id'=>'NombreAsignatura', 'placeholder'=>'Ingrese el nombre de la asignatura', 'class'=> 'form-control']) !!}
                                {!! Form::text('EstadoAsignatura', 1, ['id'=>'EstadoAsignatura','class'=> 'hidden']) !!}
                                {!! Form::text('IdAsignatura', null, ['id'=>'IdAsignatura','class'=> 'hidden']) !!}
                              </div>                          
                            </div> 
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="projectinput4">Intensidad (Horas)*</label>
                              <div class="col-md-9">                            
                                {!! Form::text('Intensidad', null, ['id'=>'Intensidad', 'placeholder'=>'Ingrese la intensidad de la asignatura', 'class'=> 'form-control']) !!}                                
                              </div>                          
                            </div>                              
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Materia *</label>
                                        <div class="col-md-9">                                                                                                                                                                            
                                        <select class="form-control m-bot15" id="IdMateriaAsig" name="IdMateria">
                                            @if($materias->count())
                                                <option class="hidden">Selecciona una opción</option>
                                            @foreach($materias as $materia)
                                                <option value="{{ $materia->IdMateria }}">{{ $materia->NombreMateria }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        </div>                                         
                                </div>                                                                         
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Tipo de asignatura *</label>
                                        <div class="col-md-9">                                                                                                                                                                            
                                        <select class="form-control m-bot15" id="IdTipoAsignaturaAsig" name="IdTipoAsignatura">
                                            @if($tipoasignaturas->count())
                                                <option class="hidden">Selecciona una opción</option>
                                            @foreach($tipoasignaturas as $tipoasignatura)
                                                <option value="{{ $tipoasignatura->IdTipoAsignatura }}">{{ $tipoasignatura->NombreTipoAsignatura }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        </div>                                         
                                </div>
                                <div class="form-group row last">
                                  <label class="col-md-3 label-control" for="projectinput9">Descripción *</label>
                                  <div class="col-md-9">                                                                  
                                      {!! Form::textarea('DescripcionAsignatura', null, ['id'=>'DescripcionAsignatura','placeholder'=>'Ingrese la descripción de la asignatura', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                                  </div>
                                </div>
                            <div class="form-actions">
                                <a href="{{ route('asignaturas') }}" class="btn btn-warning mr-1">
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

<div class="modal fade" id="asignaturasLogro">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">LISTADO DE LOGROS POR ASIGNATURA</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div class="card-content collapse show">
                  <div class="card-body card-dashboard">                    
                    <table class="table table-striped table-bordered dom-jQuery-events">
                      <thead>
                        <tr>                          
                          <th>Logros</th>                          
                        </tr>
                      </thead>
                      <tbody id="IdTBodyDetalleAsignatura">
                        
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Logros</th>                           
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div>

@endsection