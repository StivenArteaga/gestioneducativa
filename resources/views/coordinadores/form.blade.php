<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('PrimerNombre', 'Primer Nombre') }}
    {{ Form::text('PrimerNombre', null, ['class' => 'form-control']) }}
    {{ $errors->has('PrimerNombre') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('PrimerNombre') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('SegundoNombre', 'Segundo Nombre') }}
    {{ Form::text('SegundoNombre', null, ['class' => 'form-control']) }}
    {{ $errors->has('SegundoNombre') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('SegundoNombre') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('PrimerApellido', 'Primer Apellido') }}
    {{ Form::text('PrimerApellido', null, ['class' => 'form-control']) }}
    {{ $errors->has('PrimerApellido') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('PrimerApellido') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('SegundoApellido', 'Segundo Apellido') }}
    {{ Form::text('SegundoApellido', null, ['class' => 'form-control']) }}
    {{ $errors->has('SegundoApellido') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('SegundoApellido') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('IdTipoDocumento', 'Tipo de Documento') }}
    {{ Form::select('IdTipoDocumento', $tipodocumentos, null, ['class' => 'form-control']) }}
    {{ $errors->has('IdTipoDocumento') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('IdTipoDocumento') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('NumeroDocumento', 'Número de Documento') }}
    {{ Form::text('NumeroDocumento', null, ['class' => 'form-control']) }}
    {{ $errors->has('NumeroDocumento') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('NumeroDocumento') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('FechaNacimiento', 'Fecha de Nacimiento') }}
    {{ Form::date('FechaNacimiento', null, ['class' => 'form-control']) }}
    {{ $errors->has('FechaNacimiento') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('FechaNacimiento') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('IdGenero', 'Tipo de Documento') }}
    {{ Form::select('IdGenero', $generos, null, ['class' => 'form-control']) }}
    {{ $errors->has('IdGenero') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('IdGenero') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('IdTipoSangre', 'Tipo de Sangre') }}
    {{ Form::select('IdTipoSangre', $tiposangres, null, ['class' => 'form-control']) }}
    {{ $errors->has('IdTipoSangre') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('IdTipoSangre') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('Correo', 'Correo Electrónico') }}
    {{ Form::email('Correo', null, array('class' => 'form-control')) }} 
    {{ $errors->has('Correo') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('Correo') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('Direccion', 'Dirección') }}
    {{ Form::text('Direccion', null, ['class' => 'form-control']) }}
    {{ $errors->has('Direccion') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('Direccion') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('Telefono', 'Teléfono') }}
    {{ Form::text('Telefono', null, ['class' => 'form-control']) }}
    {{ $errors->has('Telefono') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('Telefono') }}</strong>
</div>

<div class="form-group col-md-4 col-lg-4">
    {{ Form::label('IdCiudad', 'Ciudad') }}
    {{ Form::select('IdCiudad', $ciudades, null, ['class' => 'form-control']) }}
    {{ $errors->has('IdCiudad') ? '' : '' }}
    <strong class="text-danger">{{ $errors->first('IdCiudad') }}</strong>
</div>
