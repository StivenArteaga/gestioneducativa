@extends('layouts.main')

@section('content')

@if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
    <p>{{ $message }}</p>
  </div>
@endif

@if ($message = Session::get('error'))
  <div class="alert alert-danger alert-dismissable custom-success-box" style="margin: 15px;">
    <p>{{ $message }}</p>
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger alert-dismissable custom-success-box" style="margin: 15px;">
    <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<section id="dom">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  {{-- @if(Auth::user()->IdTipoUsuario == 1 || Auth::user()->IdTipoUsuario == 3) --}}
                  <button class="btn btn-success">
                     <a data-toggle="modal" data-target=".bd-example-modal-lg" onclick="AsignaNumerAuto()">Nuevo alumno</a>
                  </button>
                  {{-- @endif --}}
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de alumnos</h1>
                  </div>
                  <a class="heading-elements-toggle" title="Registrar nuevo alumno"><i class="la la-ellipsis-v font-medium-3" ></i></a>                  
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>                      
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">                    
                    <table class="table table-striped table-bordered dom-jQuery-events">
                      <thead>
                        <tr>                          
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Documento</th>
                          <th>Telefono</th>
                          <th>E-Mail</th>
                          <th with="300px">Acción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($alumnos as $alumno)
                            <tr>                                
                                <td>{{ $alumno->PrimerNombre }}</td>
                                <td>{{ $alumno->PrimerApellido }}</td>
                                <td>{{ $alumno->NumeroDocumento }}</td>
                                <td>{{ $alumno->Telefono }}</td>
                                <td>{{ $alumno->Correo }}</td>
                                <td>                                       
                                <button type="button" class="btn icon-table" data-toggle="modal" data-target=".bd-example-modal-lg" onclick='Mostrar({{$alumno->IdAlumno}})'><i class="far far fa-edit"></i></button>                                                                                                    
                                {!! Form::open([ 'url'=>['alumno', $alumno->IdAlumno], 'name'=>"formularioEliminar" , 'onsubmit'=>'return confirmarEliminar()' , 'method' => 'DELETE' ,'style'=> 'display:inline' ]) !!}                                                            
                                <button type="submit" class="btn icon-table btn-delete" ><i class="far fa-trash-alt icon-size"></i></a></button>
                                {!! Form::close() !!}              
                                </td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Documento</th>
                          <th>Telefono</th>
                          <th>E-Mail</th>
                          <th>Acción</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
</section>



<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      
              <div class="card">
                <div class="card-header">
                  <h2 class="card-title">Registro de alumno</h2>
                </div>
                <div class="card-content">
                  <div class="card-body">                    
                    <ul class="nav nav-tabs nav-linetriangle no-hover-bg nav-justified">
                      <li class="nav-item">
                        <a class="nav-link active" id="active-tab3" data-toggle="tab" href="#active3" aria-controls="active3" aria-expanded="true">Datos alumno</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="link-tab3" data-toggle="tab" href="#link3" aria-controls="link3" aria-expanded="false">Datos salud</a>
                      </li>                      
                      <li class="nav-item">
                        <a class="nav-link" id="linkOpt-tab3" data-toggle="tab" href="#linkOpt3" aria-controls="linkOpt3">Datos acudiente</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="linkOpt-tab4" data-toggle="tab" href="#linkOpt4" aria-controls="linkOpt4">Datos académicos</a>
                      </li>
                    </ul>
                    <div class="tab-content px-1 pt-1">
                      <!--Contenido del formulario (hacer include o no se que joda para que aparezca jajaja)-->
                      @include('alumno/create')
                  </div>
                </div>
              </div>
            

    </div>
  </div>
</div>
</div>


<div class="modal fade" id="SegundoAcudiente">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
          <h4 class="form-section modal-title"><i class="la la-user"></i> Información Segundo Acudiente</h4>                                                              
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
      <div class="card-content collapse show">
        <form id="frmAcudientedos">
            <div class="form-body">                                               
                <div class="form-group row">                             
                  <label class="col-md-3 label-control" for="projectinput6">Tipo Acudiente *</label>
                  <div class="col-md-9">                                                        
                    <select class="form-control m-bot15" id="IdTipoAcudiente2" name="IdTipoAcudiente2">
                    @if($tipoacudiente->count())
                            <option class="hidden">Selecciona una opción</option>
                        @foreach($tipoacudiente as $tipoacudientes)
                            <option value="{{ $tipoacudientes->IdTipoAcudiente }}">{{ $tipoacudientes->NombreTipoAcudiente }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput1">Primer nombre *</label>
                  <div class="col-md-9">
                  {!! Form::text('PrimerNombreAcu2', null, ['id'=>'PrimNombAcu2','placeholder'=>'Ingrese su primer nombre', 'class'=> 'form-control valletras']) !!}
                  </div>
                </div> 
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput1">Segundo nombre</label>
                  <div class="col-md-9">                            
                    {!! Form::text('SegundoNombreAcu2', null, ['id'=>'SeguNombAcu2','placeholder'=>'Ingrese su segundo nombre', 'class'=> 'form-control valletras']) !!}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput2">Primer apellido *</label>
                  <div class="col-md-9">                            
                    {!! Form::text('PrimerApellidoAcu2', null, ['id'=>'PriApellAcu2','placeholder'=>'Ingrese su primer apellido', 'class'=> 'form-control vallel']) !!}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput2">Segundo apellido *</label>
                  <div class="col-md-9">                            
                    {!! Form::text('SegundoApellidoAcu2', null, ['id'=>'SeguApellAcu2','placeholder'=>'Ingrese su segundo apellido', 'class'=> 'form-control vallel']) !!}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput3">E-mail *</label>
                  <div class="col-md-9">                            
                    {!! Form::email('CorreoAcu2', null, ['id'=>'EmailAcu2','placeholder'=>'example@example.com', 'class'=> 'form-control']) !!}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput6">Parentesco *</label>
                  <div class="col-md-9">                                                        
                    <select class="form-control m-bot15" id="IdParentescoAcu2" name="IdParentesco2">
                    @if($parentescos->count())
                            <option class="hidden">Selecciona una opción</option>
                        @foreach($parentescos as $parentesco)
                            <option value="{{ $parentesco->IdParentesco }}">{{ $parentesco->NombreTipoParentesco }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="form-group row last">
                  <label class="col-md-3 label-control" for="projectinput9">Dirección hogar *</label>
                  <div class="col-md-9">                            
                    {!! Form::textarea('DireccionHogar2', null, ['id'=>'DirHogAcu2','placeholder'=>'Ingrese la dirección de su residencia', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput4">Telefono hogar (opcional)</label>
                  <div class="col-md-9">                            
                    {!! Form::text('TelefonoHogar2', null, ['id'=>'TelHogAcu2', 'placeholder'=>'Ingrese su numero de telefono del hogar', 'class'=> 'form-control valalfanumericoespace']) !!}
                  </div>                          
                </div>
                <div class="form-group row last">
                  <label class="col-md-3 label-control" for="projectinput9">Dirección trabajo (opcional)</label>
                  <div class="col-md-9">                            
                    {!! Form::textarea('DireccionTrabajo2', null, ['id'=>'DirTraAcu2','placeholder'=>'Ingrese la dirección de su trabajo', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput4">Telefono trabajo (opcional)</label>
                  <div class="col-md-9">                            
                    {!! Form::text('TelefonoTrabajo2', null, ['id'=>'TelTraAcu2','placeholder'=>'Ingrese su numero de telefono del trabajo', 'class'=> 'form-control valalfanumericoespace']) !!}
                  </div>                          
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput4">Telefono personal *</label>
                  <div class="col-md-9">                            
                    {!! Form::text('TelefonoCelular2', null, ['id'=>'TelPerAcu2','placeholder'=>'Ingrese su numero de telefono de celular', 'class'=> 'form-control valalfanumericoespace']) !!}
                  </div>                          
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput4">Ocupación (opcional)</label>
                  <div class="col-md-9">                            
                    {!! Form::text('Ocupacion2', null, ['id'=>'OcupAcu2','placeholder'=>'Ingrese su ocupación laboral', 'class'=> 'form-control vallel']) !!}
                  </div>                          
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput6">Tipo documento *</label>
                  <div class="col-md-9">                                                        
                    <select class="form-control m-bot15" id="IdTipoDocumentoAcu2" name="IdTipoDocumento2">
                    @if ($tipodocumentos->count())
                            <option class="hidden">Selecciona una opción</option>
                        @foreach($tipodocumentos as $tipodocumento)
                            <option value="{{ $tipodocumento->IdTipoDocumento }}">{{ $tipodocumento->NombreTipoDocumento }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput4">Numero de documento *</label>
                  <div class="col-md-9">                            
                    {!! Form::text('NumeroDocumentoAcu2', null, ['id'=>'NumDocuAcu2','placeholder'=>'Ingrese su numero de documento', 'class'=> 'form-control valnum']) !!}
                  </div>                          
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput6">Departamento expedición *</label>
                  <div class="col-md-9">                                                        
                    <select class="form-control m-bot15" id="IdDepartamentoExpAcu2" name="IdDepartamento2">
                    @if ($departamentos->count())
                            <option class="hidden">Selecciona una opción</option>
                        @foreach($departamentos as $departamento)
                            <option value="{{ $departamento->IdDepartamento }}">{{ $departamento->NombreDepartamento }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-3 label-control" for="projectinput6">Municipio expedición *</label>
                  <div class="col-md-9">                                                        
                    <select class="form-control m-bot15" id="IdMunicipioExpedicionAcu2" name="IdMunicipioExpedicion2">
                    @if ($municipios->count())
                            <option class="hidden">Selecciona una opción</option>
                        @foreach($municipios as $municipio)
                            <option value="{{ $municipio->IdMunicipio }}">{{ $municipio->NombreMunicipio }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
  
                                      
                </div> 
  
  
         
        </form>
      </div>
      </div>  
      
      <div class="modal-footer">            
          <button type="button" class="btn btn-primary" onclick="SelectForm()" data-dismiss="modal">Agregar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
  </div>
</div>

@endsection


@section('script')
<script src="js/alumno_scripts.js"></script>
    <script>

$('.valletras').on('input', function (e) {
    if (!/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+/ig,"");
    }
});

$('.vallel').on('input', function (e) {
    if (!/^[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)*$/i.test(this.value)) {
        this.value = this.value.replace(/[^a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-ZñÑáéíóúÁÉÍÓÚ]*)+/ig,"");
    }
});

$('.valnum').on('input', function (e) {
    if (!/^[0-9]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^0-9]+/ig,"");
    }
});  

$('.valalfanumericoespace').on('input', function (e) {
  if (!/^[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]*)*$/i.test(this.value)) {
        this.value = this.value.replace(/[^a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-Z-0-9-ZñÑáéíóúÁÉÍÓÚ]*)+/ig,"");
    }
});
   
$('.valpesos').on('input', function (e) {
  if (!/^[$-9-.-0]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^$-9-.-0]+/ig,"");
    }
});


function SelectForm() {
    $("#dtacudientedos").empty();
    console.log($('#dtacudientedos').val());
    SelectAcud2();
}

function SelectAcud2() {
  $("#frmAcudientedos").find(':input').each(function() {        
         var elemento= this;                  
         $("#dtacudientedos").append(
            '<input type="hidden" name="'+ elemento.id +'" value="' + elemento.value + '">'
        )
        });    
} 


function GuardarAlumno(){
  debugger;
    var request ={
      //Datos personales del alumno
      EstadoAlumno: $("#EstadoAlumno").val(),
      IdAlumno: $("#IdAlumno").val(),
      PrimerNombre: $("#PNombreA").val(),
      SegundoNombre: $("#SNombreAlum").val(),
      PrimerApellido: $("#PApellidoAlum").val(),
      SegundoApellido: $("#SApellidoAlum").val(),  
      Correo: $("#CorreoAlum").val(),
      IdTipoDocumento: $("#TipoDocumenAlum").val(),
      NumeroDocumento: $("#NDocumentAlum").val(),
      IdDepartamento: $("#DeparExpAlum").val(),
      IdMunicipioExpedido: $("#IdMunicipioExpedido").val(),
      IdGenero: $("#GenerAlum").val(),
      FechaNacimiento: $("#FechaNacAlum").val(),
      IdCiudadNacimiento: $("#CiudNaciAlum").val(),
      Direccion: $("#DirecAlum").val(),
      Zona: $("#ZonaAlum").val(),
      Telefono: $("#NumContatAlum").val(),
      IdCiudadResidencia: $("#CiudResAlum").val(),
      

      //Datos de salud del alumno
      IdEps:$("#IdEps").val(),
      Ips: $("#IpsAlum").val(),
      IdTipoSangre: $("#IdTipoSangreAlum").val(),
      Ars: $("#ArsAlum").val(),
      CarnetSisben: $("#NumCarnetAlum").val(),
      PuntajeSisben: $("#PunSisAlum").val(),
      Estrato: $("#EstraroAlum").val(),
      FuenteRecursos: $("#FuenteRecursosAlum").val(),
      MadreCabFamilia: $("#MadreCabFamiliaAlum").val(),
      HijoDeMadreCabFamilia: $("#HijoDeMadreCabFamiliaAlum").val(),
      BeneVeteranoMilitar: $("#BeneVeteranoMilitarAlum").val(),
      BeneHeroeNacional: $("#BeneHeroeNacionalAlum").val(),
      IdVictima: $("#IdVictimaAlum").val(),
      FechaExpulsion: $("#FechaExpulAlum").val(),
      IdMunicipio: $("#IdMunicipioExpAlum").val(),
      IdResguardo: $("#IdResguardoAlum").val(),
      IdEtnia: $("#IdEtniaAlum").val(),

      //Datos del acudiente del alumno
      IdTipoAcudiente: $("#IdTipoAcudiente").val(),
      PrimerNombreAcu: $("#PrimNombAcu").val(),
      SegundoNombreAcu: $("#SeguNombAcu").val(),
      PrimerApellidoAcu: $("#PriApellAcu").val(),
      SegundoApellidoAcu: $("#SeguApellAcu").val(),
      CorreoAcu: $("#EmailAcu").val(),
      IdParentesco: $("#IdParentescoAcu").val(),
      DireccionHogar: $("#DirHogAcu").val(),
      TelefonoHogar: $("#TelHogAcu").val(),
      DireccionTrabajo: $("#DirTraAcu").val(),
      TelefonoTrabajo: $("#TelTraAcu").val(),
      TelefonoCelular: $("#TelPerAcu").val(),
      Ocupacion: $("#OcupAcu").val(),
      IdTipoDocumento: $("#IdTipoDocumentoAcu").val(),
      NumeroDocumentoAcu: $("#NumDocuAcu").val(),
      IdMunicipioExpedicion: $("#IdMunicipioExpedicionAcu").val(),

      //Datos acudiente dos del alumno
      IdTipoAcudiente2: $("#IdTipoAcudiente2").val(),
      PrimerNombreAcu2: $("#PrimNombAcu2").val(),
      SegundoNombreAcu2: $("#SeguNombAcu2").val(),
      PrimerApellidoAcu2: $("#PriApellAcu2").val(),
      SegundoApellidoAcu2: $("#SeguApellAcu2").val(),
      CorreoAcu2: $("#EmailAcu2").val(),
      IdParentesco2: $("#IdParentescoAcu2").val(),
      DireccionHogar2: $("#DirHogAcu2").val(),
      TelefonoHogar2: $("#TelHogAcu2").val(),
      DireccionTrabajo2: $("#DirTraAcu2").val(),
      TelefonoTrabajo2: $("#TelTraAcu2").val(),
      TelefonoCelular2: $("#TelPerAcu2").val(),
      Ocupacion2: $("#OcupAcu2").val(),
      IdTipoDocumento2: $("#IdTipoDocumentoAcu2").val(),
      NumeroDocumentoAcu2: $("#NumDocuAcu2").val(),
      IdMunicipioExpedicion2: $("#IdMunicipioExpedicionAcu2").val(),

      //Datos de la informacion academica del alumno
      IdGrado: $("#IdGradoIfAca").val(),
      valorPension: $("#ValPensIfAca").val(),
      valorMatricula: $("#valorMatricula").val(),
      Numerolista: $("#NumLisAca").val(),
      Estado: $("#EstadoAca").val(),
      FechaEstado: $("#FechEstaAca").val(),
      CodigoInterno: $("#CodigAca").val(),
      NumeroMatricula: $("#NumMatrAca").val(),
      InstitucionOrigen: $("#InstOrigAca").val(),
      EstadoAcademicoAnterior: $("#EstaAcaAnte").val(),
      EstadoMatriculaFinal: $("#EstaMatrFinAca").val(),
      CondicionFinAno: $("#CondiFinAnoAca").val(),
      CausaTraslado: $("#CausTrasAca").val(),

    };    
    var valParam = JSON.stringify(request);
    console.log(request, valParam);
    $.get('guardalum/'+valParam, function(data){
        if(data.status == "success"){
          swal({
              type: 'success',
              title: 'Exito',
              animation: true,
              customClass: 'animated tada',
              text: data.message
            });
        }else{
          if(data.status == "warning"){
            swal({
              type: 'warning',
              title: 'Upss',
              animation: true,
              customClass: 'animated tada',
              text: data.message
            });
          }else{
            swal({
              type: 'warning',
              title: 'Upss',
              animation: true,
              customClass: 'animated tada',
              text: data.message
            });
          }
        }
    });
}
    </script>
@endsection