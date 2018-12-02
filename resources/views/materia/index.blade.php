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
                     <a data-toggle="modal" data-target=".bd-example-modal-lg">Nueva Materia</a>
                  </button>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de materias</h1>
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
                          <th>Nombre materia</th>
                          <th>Descripción</th>
                          <th>Area</th>
                          <th with="300px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($result as $results)
                            <tr>                                
                                <td>{{ $results->NombreMateria }}</td>
                                <td>{{ $results->DescripcionMateria }}</td>
                                <td>{{ $results->NombreArea }}</td>
                                <td>                                       
                                <button type="button" title="Editar Registro" class="btn icon-table" data-toggle="modal" data-target=".bd-example-modal-lg" onclick='MostrarMateria({{$results->IdMateria}})'><i class="far far fa-edit"></i></button>
                                {!! Form::open([ 'url'=>['materias', $results->IdMateria], 'method' => 'DELETE','style'=> 'display:inline' ]) !!}                                                            
                                  <button type="submit" title="Eliminar Registro" class="btn icon-table btn-delete"><i class="far fa-trash-alt icon-size"></i></a></button>
                                {!! Form::close() !!}              
                                <button type="button" class="btn icon-table" data-toggle="modal" data-target="#asignaturasMateria" onclick="DetalleMateria({{$results->IdMateria}})" ><i class="fas fa-align-justify"></i></button>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Nombre materia</th> 
                          <th>Descripción</th>                        
                          <th>Area</th>
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
                  <h2 class="card-title">REGISTRO DE MATERIA</h2>
                </div>
             <div class="card-content">
                <div class="card-body">   
                {!! Form::open(['route' => 'materias.store', 'method' => 'POST']) !!}    
                    <form class="form form-horizontal row-separator">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-user"></i> Información de materia</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Nombre de materia *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                                {!! Form::text('NombreMateria', null, ['id'=>'NombreMateria', 'placeholder'=>'Ingrese el nombre de la materia', 'class'=> 'form-control']) !!}
                                                {!! Form::text('IdMateria', null, ['id'=>'IdMateria', 'class'=> 'hidden']) !!}
                                                {!! Form::text('EstadoMateria', 1, ['class'=>'hidden']) !!}
                                            </div>
                                        </div>                                         
                                </div> 
                                <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Area *</label>
                                  <div class="col-md-9">                                                        
                                    <select class="form-control m-bot15" id="IdAreaMat" name="IdArea">
                                    @if($areas->count())
                                        <option class="hidden">Selecciona una opción</option>
                                      @foreach($areas as $area)
                                        <option value="{{ $area->IdArea }}">{{ $area->NombreArea }}</option>
                                      @endforeach
                                    @endif
                                    </select>
                                  </div>
                                </div>     
                                <div class="form-group row last">
                                  <label class="col-md-3 label-control" for="projectinput9">Descripción *</label>
                                  <div class="col-md-9">                                                                  
                                      {!! Form::textarea('DescripcionMateria', null, ['id'=>'DescripcionMateria','placeholder'=>'Ingrese la descripción de la materia', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                                  </div>
                                </div>                                        
                            <div class="form-actions">
                                <a href="{{ route('materia') }}" class="btn btn-warning mr-1">
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

<div class="modal fade" id="asignaturasMateria">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">LISTADO DE ASIGNATURAS POR MATERIA</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div class="card-content collapse show">
                  <div class="card-body card-dashboard">                    
                    <table class="table table-striped table-bordered dom-jQuery-events">
                      <thead>
                        <tr>                          
                          <th>Asignaturas</th>                          
                        </tr>
                      </thead>
                      <tbody id="IdTBodyDetalleMateria">
                        
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Asignaturas</th>                           
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

