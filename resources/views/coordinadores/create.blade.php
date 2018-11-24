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
                <h4>Registro de coordinadores</h4>
              </div>
              <div class="">
                <a href="{{ url('coordinadores') }}" class="btn btn-outline-info"><i class="fa fa-eye fa-lg"></i> Mostrar todos</a>
              </div>
            </div><hr>

            {{ Form::open(['url' => 'coordinadores']) }}
              <div class="row">
                @include('coordinadores.form')
            </div>
            {{ Form::submit('Guardar', ['class' => 'btn btn-outline-info', 'style' => 'float:right']) }}
            {{ Form::close() }}

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection