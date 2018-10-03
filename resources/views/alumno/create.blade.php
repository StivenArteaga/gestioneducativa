@extends('layouts.main')

@section('content')

@if(count($errors) > 0)
    <div class="alert alerrt">  
        <strong>Whoooops!!</strong> ha ocurrido un error con tu registro.<br>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

{!! Form::open(['route' => 'alumno.store', 'method' => 'POST']) !!}
    @include('alumno.form')
{!! Form::close() !!}

@endsection