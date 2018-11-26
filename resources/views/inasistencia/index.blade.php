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
                    <th>Nombre Asignatura</th>                     
                    <th with="300px">Grupo Por Asignatura</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($asignaturas as $asignatura)
                      <tr>                                
                          <td>
                              <i class="fas fa-atlas"></i>
                              {{ $asignatura->NombreAsignatura }}
                            </td>                          
                          <td>                                       
                            <a class="btn btn-block btn-primary" href="{{ url('inasistencia/grupo/'.$asignatura->IdAsignatura) }}"><i class="fas fa-address-book"></i></a>
                          </td>
                      </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>                        
                    <th>Nombre Asignatura</th>                    
                    <th>Grupos Por Asignatura</th>
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