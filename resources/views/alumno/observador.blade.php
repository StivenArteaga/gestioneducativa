@extends('layouts.main') 
@section('content')
<div class="row">
    <section class="col-lg-12 col-md-12 col-sm-12 d-inline-block justify-content-around">

        <ul class="nav nav-pills nav-fill bg-secondary conf" id="v-pills-tab" role="tablist" aria-orientation="vertical">

            <li class="nav-item">
                <a class="nav-link active" id="v-pills-notas-tab" data-toggle="pill" href="#v-pills-notas" role="tab" aria-controls="v-pills-notas" aria-selected="true" style="color: #fff">Mis Notas</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="v-pills-observaciones-tab" data-toggle="pill" href="#v-pills-observaciones" role="tab" aria-controls="v-pills-observaciones" aria-selected="flase" style="color: #fff">Mis Observaciones</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="v-pills-perfil-tab" data-toggle="pill" href="#v-pills-perfil" role="tab" aria-controls="v-pills-perfil" aria-selected="false" style="color: #fff">Mi perfil</a>
            </li>

        </ul>
    </section>

    <section class="container-fluid mt-2 mb-5 col-md-12">
        <div class="tab-content" id="v-pills-tabContent">
            <!--Formularios de Regional y Centro de Formación-->
            <div class="tab-pane fade show active" id="v-pills-notas" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <!--Panel de sección-->
                <div class="card border-secondary text-center">
                    <h4 class="card-header text-dark">Notas</h4>
                    <div class="card-body">
                        <div class="row">
                            {{ Form::select('periodo',$periodos, null,['class'=>'form-control col-6 mb-1', 'onchange' => 'cargarNotas(this.value)', 'placeholder'=>'Seleccione un periodo' ]) }}
                            <table class="table table-bordered mt-2 display" id="notas" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Asignatura</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!--Fin de los formularios-->
                    </div>
                </div>
            </div>

            <!--Formularios de Regional y Centro de Formación-->
            <div class="tab-pane fade show" id="v-pills-observaciones" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <!--Panel de sección-->
                <div class="card border-secondary text-center">
                    <h4 class="card-header text-dark">Observaciones al estudiante</h4>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($observaciones as $observacion )
                                <strong class="col-4 mb-1">Docente: {{ $observacion->PrimerNombreMaes . " " . $observacion->PrimerApellidoMaes }}</strong>
                                <textarea cols="30" rows="5" class="form-control col-8 mb-1" readonly>{{ $observacion['descripcion'] }}</textarea>
                            @endforeach
                        </div>
                        <!--Fin de los formularios-->
                    </div>
                </div>
            </div>

            <!--Formularios de Regional y Centro de Formación-->
            <div class="tab-pane fade show" id="v-pills-perfil" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <!--Panel de sección-->
                <div class="card border-secondary">
                    <h4 class="card-header text-dark text-center">Perfil</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                   
                                {{ Form::model($alumno, ['url' => ['alumno/update', $alumno->IdAlumno], 'class' => 'm-auto']) }}
    
                                    <div class="form-group col-md-3 d-inline-block">
                                        {{ Form::label('nombre', 'Primer Nombre') }}
                                        {{ Form::text('nombre', $alumno->PrimerNombre, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
    
                                    <div class="form-group col-md-3 d-inline-block">
                                        {{ Form::label('nombre', 'Segundo Nombre') }}
                                        {{ Form::text('nombre', $alumno->SegundoNombre, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
    
                                    <div class="form-group col-md-3 d-inline-block">
                                        {{ Form::label('nombre', 'Primer Apellido') }}
                                        {{ Form::text('nombre', $alumno->PrimerApellido, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
    
                                    <div class="form-group col-md-3 d-inline-block">
                                        {{ Form::label('nombre', 'Segundo Apellido') }}
                                        {{ Form::text('nombre', $alumno->SegundoApellido, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
                                      
                                    <div class="form-group col-md-3 d-inline-block">
                                            {{ Form::label('nombre', 'Correo') }}
                                            {{ Form::text('nombre', $alumno->Correo, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
        
                                    <div class="form-group col-md-3 d-inline-block">
                                            {{ Form::label('nombre', 'Tipo de Documento') }}
                                            {{ Form::text('nombre', $alumno->NombreTipoDocumento, ['class' => 'form-control', 'readonly' => true]) }}
                                     </div>
        
                                    <div class="form-group col-md-3 d-inline-block">
                                            {{ Form::label('nombre', 'N° de Documento') }}
                                            {{ Form::text('nombre', $alumno->NumeroDocumento, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
        
                                    <div class="form-group col-md-3 d-inline-block">
                                            {{ Form::label('nombre', 'Fecha de Nacimiento.') }}
                                            {{ Form::text('nombre', $alumno->FechaNacimiento, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
                                          
                                    <div class="form-group col-md-3 d-inline-block">
                                            {{ Form::label('nombre', 'Genero') }}
                                            {{ Form::text('nombre', $alumno->NombreGenero, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
        
                                    <div class="form-group col-md-3 d-inline-block">
                                            {{ Form::label('nombre', 'telefono') }}
                                            {{ Form::text('nombre', $alumno->Telefono, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
        
                                    <div class="form-group col-md-3 d-inline-block">
                                            {{ Form::label('nombre', 'Zona') }}
                                            {{ Form::text('nombre', $alumno->Zona, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
        
                                    <div class="form-group col-md-3 d-inline-block">
                                            {{ Form::label('nombre', 'Municipio') }}
                                            {{ Form::text('nombre', $alumno->NombreMunicipio, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>

                                    <div class="form-group col-md-9 d-inline-block">
                                            {{ Form::label('nombre', 'Dirección') }}
                                            {{ Form::text('nombre', $alumno->Direccion, ['class' => 'form-control', 'readonly' => true]) }}
                                    </div>
                                            
                                {{ Form::close() }}
                            </div>
                        </div>
                        <!--Fin de los formularios-->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
    <script type="text/javascript" src="js/alumno_scripts.js"></script>
@endsection