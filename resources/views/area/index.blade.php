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
                     <a data-toggle="modal" data-target=".bd-example-modal-lg">Nueva Área</a>
                  </button>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de areas</h1>
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
                          <th>Nombre Área</th>        
                          <th>Descripción</th>                  
                          <th with="300px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($areas as $area)
                            <tr>                                
                                <td>{{ $area->NombreArea }}</td>   
                                <td>{{ $area->DescripcionArea }}</td>
                                <td>                                       
                                <button type="button" class="btn icon-table" data-toggle="modal" data-target=".bd-example-modal-lg" onclick='MostrarArea({{$area->IdArea}})'><i class="far far fa-edit"></i></button>
                                {!! Form::open([ 'url'=>['area', $area->IdArea], 'method' => 'DELETE','style'=> 'display:inline' ]) !!}                                                            
                                  <button type="submit" class="btn icon-table"><i class="far fa-trash-alt icon-size"></i></a></button>
                                {!! Form::close() !!}                                                                                                   
                                  <button type="submit" class="btn icon-table" data-toggle="modal" data-target="#materiasArea" onclick="DetalleArea({{$area->IdArea}})"><i class="fas fa-align-justify"></i></button>
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Nombre Área</th>                  
                          <th>Descripción</th>                          
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
                  <h2 class="card-title">REGISTRO DE AREA</h2>
                </div>
             <div class="card-content">
                <div class="card-body">   
                {!! Form::open(['route' => 'area.store', 'method' => 'POST']) !!}    
                    <form class="form form-horizontal row-separator">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-user"></i> Información del area</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Nombre del area *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                                {!! Form::text('NombreArea', null, ['id'=>'NombreArea', 'placeholder'=>'Ingrese el nombre de area', 'class'=> 'form-control', 'pattern'=>'[A-Za-z]{4-50}']) !!}
                                                {!! Form::text('IdArea', null, ['id'=>'IdArea', 'placeholder'=>'Ingrese el nombre de area', 'class'=> 'form-control hidden']) !!}
                                                {!! Form::text('EstadoArea', 1, ['class'=>'hidden']) !!}
                                            </div>
                                        </div>                                         
                                </div>  
                                <div class="form-group row last">
                                  <label class="col-md-3 label-control" for="projectinput9">Descripción *</label>
                                  <div class="col-md-9">                            
                                      {!! Form::textarea('DescripcionArea', null, ['id'=>'DescripcionArea','placeholder'=>'Ingrese la descripción del area', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                                  </div>
                                </div>       
                            <div class="form-actions">
                                <a href="{{ route('areas') }}" class="btn btn-warning mr-1">
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


<div class="modal fade" id="materiasArea">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">LISTADO DE MATERIAS POR AREA</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div class="card-content collapse show">
                  <div class="card-body card-dashboard">                    
                    <table class="table table-striped table-bordered dom-jQuery-events">
                      <thead>
                        <tr>                          
                          <th>Materias</th>                          
                        </tr>
                      </thead>
                      <tbody id="IdTableBodyDetalleArea">                      
                                            
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Materias</th>                           
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