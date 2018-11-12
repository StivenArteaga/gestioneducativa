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
                  {{-- @if(Auth::user()->IdTipoUsuario == 1 || Auth::user()->IdTipoUsuario == 3) --}}
                  <button class="btn btn-success">
                     <a data-toggle="modal" data-target=".bd-example-modal-lg" onclick="AsignaNumerAuto()">Nuevo alumno</a>
                  </button>
                  {{-- @endif --}}
                  
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
                      <!--Contenido del formulario (hacer include o no se que joda para que aparezca jajaja)-->
                      @include('alumno/create')
                  </div>
                </div>
              </div>
            

    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $().ready(function() {
    $('#alumno_form').validate({
        rules: {
            PrimerNombre: {
                required: true
            },
            SegundoNombre: {
                required: true
            }
        },
        messages: {
            PrimerNombre: {
                required: "El campo Nombres es obligatorio."
            },
            SegundoNombre: {
                required: "El campo Apellidos es obligatorio."
            },
        }
    });
  });
</script>
@endsection