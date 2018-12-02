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
            <div class="text-center">
              <h1 class="card-title">Listado de asignaturas por docente</h1>
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
                    <th>Nombre Alumo</th>                     
                    <th>Fecha Inasistencia</th>
                    <th with="300px">Aplicar Inasistencia</th>
                    <th>Numero Inasitencia</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($alumnos as $alumno)
                      <tr>                                
                          <td>
                              <i class="fas fa-atlas"></i>
                                {{ $alumno->PrimerNombre .' '.$alumno->PrimerApellido.' '.$alumno->SegundoApellido }}
                            </td>           
                          <td>
                          <input type="date" class="form-control" id="FechaInasistencia">
                          </td>                 
                          <td>                                       
                            <a class="btn btn-block btn-success" href="{{ url('inasistenciasalumnos/'.$alumno.'/'.$IdAsignatura) }}"><i class="fas fa-user-plus" ></i> Agregar Inasistencia</a>                            
                          </td>
                          <td>
                            <input type="text" class="form-control col-md-3" id="Inasistencia" value="{{ $alumno->created_at }}" disabled>
                          </td>
                      </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>                        
                    <th>Nombre Alumno</th>     
                    <th>Fecha Inasistencia</th>               
                    <th>Aplicar Inasistencia</th>
                    <th>Numero Inasitencia</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>


@endsection

@section('script')
  <script>
 function AgregarInasistencia(idalumno, idasignatura){
          var FechaInasistencia = $("#FechaInasistencia").val();
          var request ={
              IdAlumno: idalumno,
              IdAsignatura: idasignatura,
              FechaInasistencia: FechaInasistencia
            };
          
          var dt = JSON.stringify(request);
          console.log(dt);
        $.get('inasistenciasalumnos/'+dt, function (data) {
            if(data.status == "success"){
                swal({
                    type: 'success',
                    title: 'Éxito',
                    animation: true,
                    customClass: 'animated tada',
                    text: data.message
                });
                $("#Inasistencia").val($("#Inasistencia").val()+1);
            }else{
                swal({
                    type: 'warning',
                    title: 'Upss',
                    animation: true,
                    customClass: 'animated tada',
                    text: data.message
                });  
            }
        });
      }
  </script>
@endsection