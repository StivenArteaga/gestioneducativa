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
                     <a data-toggle="modal" data-target=".bd-example-modal-lg">Nuevo Logro</a>
                  </button>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de logros</h1>
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
                          <th>Nombre Asignatura</th> 
                          <th>Periodo</th>
                          <th>Descripción Logro</th>
                          <th with="300px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($logros as $logro)
                            <tr>                                
                                <td>{{ $logro->NombreAsignatura }}</td>
                                <td>{{ $logro->NumeroPeriodo }}</td>
                                <td>{{ $logro->DescripcionLogro }}</td>
                                <td>                                       
                                  <button type="button" title="Editar Registro" class="btn icon-table" data-toggle="modal" data-target=".bd-example-modal-lg" onclick='MostrarLogro({{$logro->IdLogro}})'><i class="far far fa-edit"></i></button>
                                {!! Form::open([ 'url'=>['logro', $logro->IdLogro], 'method' => 'DELETE','style'=> 'display:inline' ]) !!}                                                            
                                  <button type="submit" title="Eliminar Registro" class="btn icon-table btn-delete"><i class="far fa-trash-alt icon-size"></i></a></button>
                                {!! Form::close() !!}               
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Nombre Asignatura</th>
                          <th>Periodo</th>
                          <th>Descripción Logro</th>
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
                  <h2 class="card-title">REGISTRO DE LOGRO</h2>
                </div>
             <div class="card-content">
                <div class="card-body">   
                {!! Form::open(['route' => 'logro.store', 'method' => 'POST']) !!}    
                    <form class="form form-horizontal row-separator">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-user"></i> Información de logro</h4>
                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Asignatura *</label>
                                  <div class="col-md-9">                                                        
                                    <select class="form-control m-bot15" id="IdAsignatura" name="IdAsignatura">
                                    @if($asignaturas->count())
                                      <option class="hidden">Selecciona una opción</option>
                                    @foreach($asignaturas as $asignatura)
                                      <option value="{{ $asignatura->IdAsignatura }}">{{ $asignatura->NombreAsignatura }}</option>
                                    @endforeach
                                  @endif
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput6">Periodo *</label>
                                  <div class="col-md-9">                                                        
                                    <select class="form-control m-bot15" id="IdPeriodo" name="IdPeriodo">
                                    @if($periodos->count())
                                      <option class="hidden">Selecciona una opción</option>
                                    @foreach($periodos as $periodo)
                                      <option value="{{ $periodo->IdPeriodo }}">{{ $periodo->NumeroPeriodo }}</option>
                                    @endforeach
                                  @endif
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Descripción del logro *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                            {!! Form::textarea('DescripcionLogro', null, ['id'=>'DescripLogro','placeholder'=>'Ingrese la descripción del logro', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                                                {!! Form::text('IdLogro', null, ['id'=>'IdLogro', 'class'=> 'hidden']) !!}
                                                {!! Form::text('EstadoLogro', 1, ['class'=>'hidden']) !!}
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

@endsection