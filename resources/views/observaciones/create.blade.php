@extends('layouts/main')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card border-secondary">
        <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <h4>Registro de Observaciones</h4>
              </div>
              <div>
                <a href="{{ url('observaciones') }}" class="btn btn-outline-info"><i class="fa fa-eye fa-lg"></i> Mostrar todos</a>
              </div>
            </div><hr>
          <form action="{{ url('observaciones/store') }}" method="post">
            @csrf
            <div class="form-group">
                  <label><i class="fa fa-mouse-pointer"></i> Seleccionar Alumno <strong class="text-danger" style="font-size: 23px">*</strong></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-plus-circle"></i></span>
                    </div>
                    <select class="form-control {{$errors->has('IdAlumno') ? 'is-invalid' : ''}}" name="IdAlumno" id="IdAlumno" required>
                      <option hidden value="{{old('IdAlumno')}}"> -- Seleccionar Alumno -- </option>
                      @foreach ($alumnos as $alumno)
                        <option value="{{ $alumno->IdAlumno }}">{{ $alumno->PrimerNombre.' '.$alumno->PrimerApellido }}</option>
                      @endforeach
                    </select>
                    <strong class="invalid-feedback">{{$errors->first('IdAlumno')}}</strong>
                  </div>
              </div>

            <div class="form-group">
              <label><i class="fa fa-edit"></i> Descripción de la observación <strong class="text-danger" style="font-size: 23px">*</strong></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-barcode fa-plus-circle"></i></span>
                </div>
                <textarea id="descripcion" class="form-control {{$errors->has('descripcion') ? 'is-invalid' : ''}}" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="off" maxlength="255">
              </textarea>
                <strong class="invalid-feedback">{{$errors->first('descripcion')}}</strong>
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