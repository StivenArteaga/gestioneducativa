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
                     <a data-toggle="modal" data-target=".bd-example-modal-lg">Nueva Sede</a>
                  </button>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de sedes</h1>
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
                          <th>Nombre Sede</th>                                  
                          <th with="300px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($sedes as $sede)
                            <tr>                                
                                <td>{{ $sede->NombreSede }}</td>                                   
                                <td>                                        
                                <button type="button" class="btn icon-table" data-toggle="modal" data-target=".bd-example-modal-lg" onclick='MostrarSede({{$sede->IdSede}})'><i class="far far fa-edit"></i></button>
                                {!! Form::open([ 'url'=>['sede', $sede->IdSede], 'method' => 'DELETE','style'=> 'display:inline' ]) !!}                                                            
                                  <button type="submit" class="btn icon-table btn-delete"><i class="far fa-trash-alt icon-size"></i></a></button>
                                {!! Form::close() !!}                                                                                                                                                                                                                                                                                           
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Nombre Sede</th>        
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
                  <h2 class="card-title">REGISTRO DE SEDE</h2>
                </div>
             <div class="card-content">
                <div class="card-body">   
                {!! Form::open(['route' => 'sede.store', 'method' => 'POST']) !!}    
                    <form class="form form-horizontal row-separator">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-user"></i> Información de sede</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Nombre de la sede *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                                {!! Form::text('NombreSede', null, ['id'=>'NombreSede', 'placeholder'=>'Ingrese el nombre de la jornada', 'class'=> 'form-control']) !!}
                                                {!! Form::text('IdSede', null, ['id'=>'IdSede','class'=> 'hidden']) !!}
                                                {!! Form::text('IdInstitucion', 1, ['id'=>'IdInstitucion','class'=> 'hidden']) !!}
                                                {!! Form::text('EstadoSede', 1, ['class'=>'hidden']) !!}
                                            </div>
                                        </div>                                         
                                </div>                                 
                            <div class="form-actions">
                                <a href="{{ route('sedes') }}" class="btn btn-warning mr-1">
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