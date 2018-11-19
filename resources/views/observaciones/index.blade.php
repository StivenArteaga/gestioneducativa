@extends('layouts/main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Lista de observaciones</h4>
                </div>

                <div>
                    <a href="{{ url('observaciones/create') }}" class="btn btn-outline-info ml-2">Agregar nueva observación</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="obsevacionesTable">
                            <thead>
                                <tr>
                                    <th>Coordinador</th>
                                    <th>Alumno</th>
                                    <th>Observación</th>
                                    <th colspan="2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($observaciones as $observacion)    
                                <tr>
                                    <td>{{ $observacion->Nombres }}</td>
                                    <td>{{ $observacion->PrimerNombre. ' '.$observacion->PrimerApellido }}</td>
                                    <td>{{ $observacion->descripcion }}</td>
                                    <td>
                                        <a href="{{ url('observaciones/'.$observacion->IdObservacion.'/edit') }}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection