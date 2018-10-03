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

@if ($message = Session::get('danger'))
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
                     <a data-toggle="modal" data-target=".bd-example-modal-lg">Nueva Matricula</a>
                  </button>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de alumnos matriculados</h1>
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
                          <th>Numero Documento</th>        
                          <th>Nombre Completo</th>                  
                          <th>Grado</th>                  
                          <th with="300px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($alumnosmatriculados as $alumnosmatriculado)
                            <tr>                                
                                <td>{{ $alumnosmatriculado->NumeroDocumento }}</td>
                                <td>{{ $alumnosmatriculado->PrimerNombre}}  {{$alumnosmatriculado->SegundoNombre}}   {{$alumnosmatriculado->PrimerApellido}}  {{$alumnosmatriculado->SegundoApellido}}</td>                                   
                                <td>{{ $alumnosmatriculado->NombreGrado }}</td>
                                <td>                                                                        
                                <button type="button" class="btn icon-table" data-toggle="modal" data-target="#matricularAlum" onclick="listAlumMatr({{$alumnosmatriculado->IdAlumno}})"><i class="far far fa-edit"></i></button>
                                {!! Form::open([ 'url'=>['matricula', $alumnosmatriculado->IdMatricula], 'method' => 'DELETE','style'=> 'display:inline' ]) !!}                                                            
                                  <button type="submit" class="btn icon-table" ><i class="far fa-trash-alt icon-size"></i></a></button>
                                {!! Form::close() !!}                                                                                                                                                                                                                                                                                           
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Numero Documento</th>        
                          <th>Nombre Completo</th>                  
                          <th>Grado</th>                     
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
                  <h2 class="card-title">Registro de matriculas</h2>
                </div>
             <div class="card-content">
                <div class="card-body">   
                {!! Form::open(['route' => 'matricula.store', 'method' => 'POST']) !!}    
                    <form class="form form-horizontal row-separator">
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-user"></i> Listado de alumnos prematriculados</h4>
                            <div class="card-body card-dashboard">                    
                                <table class="table table-striped table-bordered dom-jQuery-events">
                                <thead>
                                    <tr>                      
                                    <th>Numero Documento</th>    
                                    <th>Nombre Completo</th>                          
                                    <th>Grado</th>
                                    <th>Matricular</th>
                                    </tr>
                            </thead>
                                <tbody>                      
                                @foreach($alumnossinmatricular as $alumnossinmatricula)
                                        <tr>                                
                                            <td>{{ $alumnossinmatricula->NumeroDocumento }}</td>                                            
                                            <td>{{ $alumnossinmatricula->PrimerNombre }}  {{ $alumnossinmatricula->PrimerApellido }}  {{ $alumnossinmatricula->SegundoApellido }}</td>
                                            <td>{{ $alumnossinmatricula->NombreGrado }}</td>                                                                        
                                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#matricularAlum" onclick="listAlumMatr({{$alumnossinmatricula->IdAlumno}})"><i class="fas fa-graduation-cap"></i></button></td> 
                                        </tr>
                                    @endforeach        
                                </tbody>
                                <tfoot>
                                    <tr>                        
                                    <th>Numero Documento</th>    
                                    <th>Nombre Completo</th>                          
                                    <th>Grado</th>
                                    <th>Matricular</th>                
                                    </tr>
                                </tfoot>
                                </table>
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


<div class="modal fade" id="matricularAlum">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Matricula de alumno</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <div class="card-content collapse show">
        {!! Form::open(['route' => 'matricula.store', 'method' => 'POST']) !!}    
                    <form class="form form-horizontal row-separator">
                        <div class="form-body">                            
                                <div class="form-group row">                                                                            
                                            <input type="text" class="hidden">                                                                                     
                                                {!! Form::text('IdMatricula', null, ['id'=>'IdMatricula','class'=>'hidden']) !!}   
                                                {!! Form::text('EstadoMatricula', 1, ['class'=>'hidden']) !!}                                                                                                                    
                                </div>  
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput6">Nombre del alumno *</label>
                                    <div class="col-md-9">                                                        
                                        <select class="form-control m-bot15" id="IdAlumnoName" name="IdAlumnoName" disabled="disabled">
                                        @if ($alumnos->count())                                                
                                            @foreach($alumnos as $alumno) 
                                                <option value="{{ $alumno->IdAlumno }}">{{ $alumno->PrimerNombre }}  {{ $alumno->PrimerApellido }}  {{ $alumno->SegundoApellido }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput6">Grado *</label>
                                    <div class="col-md-9">                                                        
                                        <select class="form-control m-bot15" id="IdGradoName" name="IdGradoName">
                                        @if ($grados->count())                                                
                                            @foreach($grados as $grado) 
                                                <option value="{{ $grado->IdGrado }}">{{ $grado->NombreGrado }}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput2">Valor Matricula *</label>
                                        <div class="col-md-9">                            
                                            {!! Form::text('ValorMatricula', null, ['id'=>'ValorMatricula','placeholder'=>'Ingrese el valor de su matricula', 'class'=> 'form-control']) !!}
                                        </div>
                                </div>
                                <div class="form-actions">
                                    <a href="{{ route('matriculas') }}" class="btn btn-warning mr-1"><i class="la la-remove"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-primary"><i class="la la-check"></i> Guardar</button>
                                </div>                       
                        </div>    
                    </form>                                   
                {!! Form::close() !!} 
        </div>        
              
      </div>
      
    </div>
</div>


@endsection
