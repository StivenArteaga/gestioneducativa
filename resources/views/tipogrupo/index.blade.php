@extends('layouts.main')

@section('content')


@if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
    <p>{{ $message }}</p>
  </div>
@endif

@if ($message = Session::get('errors'))
  <div class="alert alert-danger alert-dismissable custom-success-box" style="margin: 15px;">
    <p>{{ $message }}</p>
  </div>
@endif




<section id="dom">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <button class="btn btn-success">
                     <a data-toggle="modal" data-target=".bd-example-modal-lg">Nuevo Tipo Grupo</a>
                  </button>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de tipos de grupos</h1>
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
                          <th>Nombre Tipo De Grupo</th>                          
                          <th with="300px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($tipogrupos as $tipogrupo)
                            <tr>                                
                                <td>{{ $tipogrupo->NombreTipoGrupo }}</td>                                
                                <td>                                       
                                  <button type="button" class="btn icon-table" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="MostrarTipoGrupo({{$tipogrupo->IdTipoGrupo}})"><i class="far far fa-edit"></i></button>
                                {!! Form::open([ 'url'=>['tgrupo', $tipogrupo->IdTipoGrupo], 'method' => 'DELETE','style'=> 'display:inline' ]) !!}
                                  <button type="submit" class="btn icon-table"><i class="far fa-trash-alt icon-size"></i></a></button>
                                {!! Form::close() !!}               
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr> 
                          <th>Nombre Tipo De Grupo</th>                          
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
                {!! Form::open(['route' => 'tgrupo.store', 'method' => 'POST']) !!}    
                    <form class="form form-horizontal row-separator">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-user"></i> Información de tipo de grupos</h4>                                                                                               
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Nombre Tipo Grupo *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                                {!! Form::text('NombreTipoGrupo', null, ['id'=>'NombreTipoGrupo', 'class'=> 'form-control', 'placeholder'=>'Ingrese el nombre del tipo de grupo']) !!}                                                                                                      
                                                {!! Form::text('IdTipoGrupo', null, ['id'=>'IdTipoGrupo', 'class'=> 'hidden']) !!}                                     
                                                {!! Form::text('EstadoTipoGrupo', 1, ['class'=>'hidden']) !!}                                                                                         
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
                                <a href="{{ route('tgrupos') }}" class="btn btn-warning mr-1">
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