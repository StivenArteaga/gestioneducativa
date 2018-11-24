@extends('layouts.main')
@section('content')
  <div class="container">
    <div class="row mt-1">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-info text-center"><h4 style="color:white">Gestión de Coordinadores</h4></div>
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="">
                <h4>Editar Coordinador</h4>
              </div>
              <div class="">
                <a href="{{ url('coordinadores') }}" class="btn btn-outline-info"><i class="fa fa-eye"></i> Mostrar todos</a>
              </div>
            </div><hr>

            {{ Form::model($coordinador, ['url' => ['coordinadores', $coordinador->IdCoordinador], 'method' => 'PATCH']) }}

              <div class="row">
                @include('coordinadores.form')
              </div>
              {{ Form::submit('Actualizar', ['class' => 'btn btn-outline-info', 'style' => 'float:right']) }}

            {{ Form::close() }}

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection