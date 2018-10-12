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
                    <div class="form-group row">                        
                            <div class="col-md-6">                                                        
                            <label class="col-md-6 label-control" for="projectinput6">Filtro por grado</label>
                               <select class="form-control m-bot15 target" id="IdGradoEv" name="IdGrado">
                                @if($grados->count())
                                    <option class="hidden">Selecciona una opción</option>
                                @foreach($grados as $grado)
                                    <option value="{{ $grado->IdGrado }}">{{ $grado->NombreGrado }}</option>
                                @endforeach
                                @endif
                                </select>
                            </div>
                    </div>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de asignatura</h1>
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
                          <th with="300px">Evaluar</th>
                        </tr>
                      </thead>
                      <tbody id="TblAsignaturaEvaluBody">                      
                            
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Asignatura</th>                                                                             
                          <th>Evaluar</th>
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
    <div class="modal-content" style="width: 130%;">

            
              <div class="card">                  
                  <div class="card-content">
                      <div class="card-body">   
                      <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">                                                      
                        
                        <div class="text-center">
                          <h1 class="card-title">Evaluación de alumnos por asignatura</h1>
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
                                <th with="30px">N° lista</th>                                                  
                                <th>Nombre</th>
                                <th with="700px">1° Periodo</th>
                                <th with="700px"v>2° Periodo</th>
                                <th with="700px">3° Periodo</th>
                                <th with="700px">4° Periodo</th>
                                <th with="300px">Acción</th>
                              </tr>                              
                            </thead>
                            <tbody id="TblListAlumEval">                                                                                    
                                                                
                            </tbody>
                            <tfoot>
                            <tr>                          
                                <th>N° lista</th>                                                  
                                <th>Nombre</th>
                                <th>1° Periodo</th>
                                <th>2° Periodo</th>
                                <th>3° Periodo</th>
                                <th>4° Periodo</th>
                                <th>Acción</th>
                              </tr>                              
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
            </div>
        </div>            

    </div>
  </div>
</div>

@endsection


