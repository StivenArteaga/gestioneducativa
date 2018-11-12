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

    <section class="container-fluid mt-2 mb-5 col-12">
        <div class="tab-content" id="v-pills-tabContent">
            <!--Formularios de Regional y Centro de Formación-->
            <div class="tab-pane fade show active" id="v-pills-notas" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <!--Panel de sección-->
                <div class="card border-secondary text-center">
                    <h4 class="card-header text-dark">Notas</h4>
                    <div class="card-body">
                        <div class="row">
                            {{ Form::select('periodo',$periodos,null,['class'=>'form-control col-6 mb-1', 'onchange' => 'cargarNotas(this.value)', 'placeholder'=>'Seleccione un periodo' ]) }}
                            <table class="table table-bordered mt-2" id="notas">
                                <thead>
                                    <tr>
                                        <th>Periodo</th>
                                        <th>Asignatura</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notas as $nota)
                                    <tr>
                                        <td>{{ $nota['NumeroPeriodo'] }}</td>
                                        <td>{{ $nota['NombreMateria'] }}</td>
                                        <td>{{ $nota['NombreNota'] }}</td>
                                        {{-- {{ dump($nota['NumeroPeriodo']) }} --}}
                                    </tr>
                                    @endforeach
                                </tbody>
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

                        </div>
                        <!--Fin de los formularios-->
                    </div>
                </div>
            </div>

            <!--Formularios de Regional y Centro de Formación-->
            <div class="tab-pane fade show" id="v-pills-perfil" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <!--Panel de sección-->
                <div class="card border-secondary text-center">
                    <h4 class="card-header text-dark">Perfil</h4>
                    <div class="card-body">
                        <div class="row">
                            {{ Form::model($alumno, ['url' => 'alumno/update']) }}

                            {{ Form::close() }}
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