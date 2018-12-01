@extends('layouts/main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="card-title">Lista de Coordinadores</h4>
                </div>

                <div>
                    <a href="{{ url('coordinadores/create') }}" class="btn btn-outline-info ml-2">Agregar Coordinador</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="coordinadoresTable">
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Tipo de documento</th>
                                    <th>Número de documento</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Género</th>
                                    <th>Tipo de Sangre</th>
                                    <th>Correo</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Ciudad</th>
                                    <th colspan="2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coordinadores as $coordinador)    
                                <tr>
                                    <td>{{ $coordinador->PrimerNombre.' '.$coordinador->SegundoNombre }}</td>
                                    <td>{{ $coordinador->PrimerApellido. ' '.$coordinador->SegundoApellido }}</td>
                                    <td>{{ $coordinador->NombreTipoDocumento }}</td>
                                    <td>{{ $coordinador->NumeroDocumento }}</td>
                                    <td>{{ $coordinador->FechaNacimiento }}</td>
                                    <td>{{ $coordinador->NombreGenero }}</td>
                                    <td>{{ $coordinador->NombreTipoSangre }}</td>
                                    <td>{{ $coordinador->Correo }}</td>
                                    <td>{{ $coordinador->Direccion }}</td>
                                    <td>{{ $coordinador->Telefono }}</td>
                                    <td>{{ $coordinador->NombreCiudad }}</td>
                                    <td>
                                        <a title="Editar Registro" href="{{ url('coordinadores/'.$coordinador->IdCoordinador.'/edit') }}" class="btn btn-secondary"><i class="fa fa-edit"></i></a>

                                        {{ Form::open([ 'url'=>['coordinadores', $coordinador->IdCoordinador], 'name'=>"formularioEliminar" , 'onsubmit'=>'return confirmarEliminar()' , 'method' => 'DELETE' ,'style'=> 'display:inline' ]) }}

                                            <button title="Eliminar Registro" type="submit" class="btn btn-default btn-delete" ><i class="far fa-trash-alt fa-lg"></i></a></button>
                                            
                                        {{ Form::close() }}
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

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-delete').click(function(e) {
                e.preventDefault();
                if (!confirm("¿Esta seguro que desea eliminar este registro?")) {
                    return false;
                }

                let row = $(this).parents('tr');
                let form = $(this).parents('form');
                let url = form.attr('action');

                $.post(url, form.serialize(), function(result) {
                    row.fadeOut();
                    swal('mensaje', '' + result.message + '', 'success');
            });
        });
    })
    </script>
@endsection