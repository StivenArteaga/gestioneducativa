@extends('layouts/main')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card border-secondary">
        <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h4>Editar Observaciones</h4>
              </div>
              <div>
                <a href="{{ url('observaciones') }}" class="btn btn-outline-info"><i class="fa fa-eye fa-lg"></i> Mostrar todos</a>
              </div>
            </div><hr>
            {{ Form::model($observaciones, ['url' => ['observaciones/update', $observaciones->IdObservacion]]) }}
            <div class="form-group">
                  <label><i class="fa fa-mouse-pointer"></i> Seleccionar Alumno <strong class="text-danger" style="font-size: 23px">*</strong></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-plus-circle"></i></span>
                    </div>
                    {{ Form::select('IdAlumno', $alumnos, null, ['class' => 'form-control']) }}
                    <strong class="invalid-feedback">{{$errors->first('IdAlumno')}}</strong>
                  </div>
              </div>

            <div class="form-group">
              <label><i class="fa fa-edit"></i> Descripción de la observación <strong class="text-danger" style="font-size: 23px">*</strong></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-barcode fa-plus-circle"></i></span>
                </div>
                {{ Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => '3']) }}
                {{$errors->has('descripcion') ? '' : ''}}
                <strong class="text-danger">{{$errors->first('descripcion')}}</strong>
              </div>
            </div>

            <button type="submit" class="btn btn-outline-info btn-block">Agregar Observación</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection