<div role="tabpanel" class="tab-pane active" id="active3" aria-labelledby="active-tab3" aria-expanded="true">
    {!! Form::open(['form form-horizontal row-separator', 'id' => 'alumno_form']) !!}
        <div class="form-body">
            <h4 class="form-section"><i class="la la-user"></i> Información personal</h4>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">Primer nombre *</label>
                <div class="col-md-9">
                    <input type="text" class="hidden"> 
                    {!! Form::text('PrimerNombre', null, ['id'=>'PNombreA', 'placeholder'=>'Ingrese su primer nombre', 'class'=> 'form-control valletras']) !!} 
                    {!! Form::text('Usuario', null, ['placeholder'=>'Ingrese su primer nombre','class'=> 'form-control hidden']) !!} 
                    {!! Form::text('IdUsuario', null, ['placeholder'=>'Ingrese su primer nombre', 'class'=> 'form-control hidden']) !!} 
                    {!! Form::text('EstadoAlumno', true, ['id'=>'EstadoAlumno','placeholder'=>'Ingrese su primer nombre','class'=> 'form-control hidden']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">Segundo nombre</label>
                <div class="col-md-9">
                    {!! Form::text('SegundoNombre', null, ['id'=>'SNombreAlum','placeholder'=>'Ingrese su segundo nombre', 'class'=> 'form-control valletras']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput2">Primer apellido *</label>
                <div class="col-md-9">
                    {!! Form::text('PrimerApellido', null, ['id'=>'PApellidoAlum', 'placeholder'=>'Ingrese su primer apellido', 'class'=> 'form-control vallel']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput2">Segundo apellido *</label>
                <div class="col-md-9">
                    {!! Form::text('SegundoApellido', null, ['id'=>'SApellidoAlum','placeholder'=>'Ingrese su segundo apellido', 'class'=> 'form-control vallel']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput3">E-mail *</label>
                <div class="col-md-9">
                    {!! Form::email('Correo', null, ['id'=>'CorreoAlum','placeholder'=>'example@example.com', 'class'=> 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Tipo documento *</label>
                <div class="col-md-9">

                    <select class="form-control m-bot15" id="TipoDocumenAlum" name="IdTipoDocumento">
                      @if($tipodocumentos->count())
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
                    {!! Form::text('NumeroDocumento', null, ['id'=>'NDocumentAlum','placeholder'=>'Ingrese su numero de documento', 'class'=> 'form-control valnum']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Departamento expedición *</label>
                <div class="col-md-9">
                    <select class="form-control m-bot15 dpto" id="DeparExpAlum" name="IdDepartamento">
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
                    <select class="form-control m-bot15 mpio" id="IdMunicipioExpedido" name="IdMunicipioExpedido">
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Genero *</label>
                <div class="col-md-9">
                    <select class="form-control m-bot15" id="GenerAlum" name="IdGenero">
                      @if ($generos->count())
                            <option class="hidden">Selecciona una opción</option>
                        @foreach($generos as $genero)
                            <option value="{{ $genero->IdGenero }}">{{ $genero->NombreGenero }}</option>
                        @endforeach
                      @endif
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="timesheetinput3">Fecha de nacimiento *</label>
                <div class="col-md-9">
                    <div class="position-relative has-icon-left">
                        {!! Form::date('FechaNacimiento', null, ['id'=>'FechaNacAlum','placeholder'=>'01/01/2011', 'class'=> 'form-control']) !!}
                        <div class="form-control-position">
                            <i class="la la-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Departamento nacimiento *</label>
                <div class="col-md-9">
                    <select class="form-control m-bot15" id="DeparNacAlum" name="IdDepartamento">
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
                <label class="col-md-3 label-control" for="projectinput6">Ciudad nacimiento *</label>
                <div class="col-md-9">
                    <select class="form-control m-bot15" id="CiudNaciAlum" name="IdCiudadNacimiento"></select>
                </div>
            </div>
            <div class="form-group row last">
                <label class="col-md-3 label-control" for="projectinput9">Dirección *</label>
                <div class="col-md-9">
                    {!! Form::textarea('Direccion', null, ['id'=>'DirecAlum','placeholder'=>'Ingrese la dirección de su residencia', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Zona *</label>
                <div class="col-md-9">
                    <select class="form-control m-bot15" id="ZonaAlum" name="Zona">
                      <option class="hidden">Selecciona una opción</option>
                      <option value="1">Rural</option>
                      <option vlue="2">Urbana</option>
                    </select>
                </div>
            </div>
            <div class="form-group row last">
                <label class="col-md-3 label-control" for="projectinput4">Numero de contacto *</label>
                <div class="col-md-9">
                    {!! Form::text('Telefono', null, ['id'=>'NumContatAlum','placeholder'=>'Ingrese su numero de telefono', 'class'=> 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Departamento residencia *</label>
                <div class="col-md-9">
                    <select class="form-control m-bot15 dpto" id="DeparResidAlum" name="IdDepartamento">
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
                <label class="col-md-3 label-control" for="projectinput6">Ciudad residencia *</label>
                <div class="col-md-9">
                    <select class="form-control m-bot15" id="CiudResAlum" name="IdCiudadResidencia"></select>
                </div>
            </div>
        </div>

</div>

<div class="tab-pane" id="link3" role="tabpanel" aria-labelledby="link-tab3" aria-expanded="false">

    <div class="form-body">
        <h4 class="form-section"><i class="la la-user"></i> Información salud</h4>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Eps *</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdEps" name="IdEps">
                  @if($eps->count())
                    <option class="hidden">Selecciona una opción</option>
                    @foreach($eps as $eps)
                      <option value="{{ $eps->IdEps }}">{{ $eps->NombreEps }}</option>
                    @endforeach
                  @endif
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Ips *</label>
            <div class="col-md-9">
                {!! Form::text('Ips', null, ['id'=>'IpsAlum', 'placeholder'=>'Ingrese su ips', 'class'=> 'form-control vallel']) !!} 
                {!! Form::text('IdAlumno', null, ['id'=>'IdAlumno','class'=> 'hidden']) !!} 
                {!! Form::text('EstadoAlumno', 1, ['class'=>'hidden']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Tipo sangre *</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdTipoSangreAlum" name="IdTipoSangre">
                  @if($tiposangres->count())
                      <option class="hidden">Selecciona una opción</option>
                    @foreach($tiposangres as $tiposangre)
                        <option value="{{ $tiposangre->IdTipoSangre }}">{{ $tiposangre->NombreTipoSangre }}</option>
                    @endforeach
                  @endif
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Codigo Familia En Acción *</label>
            <div class="col-md-9">
                {!! Form::text('Ars', null, ['id'=>'ArsAlum','placeholder'=>'Ingrese su ars', 'class'=> 'form-control valalfanumericoespace']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput2">Numero de ficha del sisben *</label>
            <div class="col-md-9">
                {!! Form::text('CarnetSisben', null, ['id'=>'NumCarnetAlum','placeholder'=>'Ingrese el numero de su carnet del sisben', 'class'=> 'form-control valnum']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput2">Puntaje sisben *</label>
            <div class="col-md-9">
                {!! Form::text('PuntajeSisben', null, ['id'=>'PunSisAlum','placeholder'=>'Ingrese el puntaje de sus sisben', 'class'=> 'form-control valnum']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput3">Estrato *</label>
            <div class="col-md-9">
                {!! Form::text('Estrato', null, ['id'=>'EstraroAlum','placeholder'=>'Ingrese en numero de su estrato', 'class'=> 'form-control valnumestrato']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Fuente de recursos (opcional)</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="FuenteRecursosAlum" name="FuenteRecursos">           
                  <option class="hidden">Selecciona una opción</option>                                
                  <option value="FNR">Fnr</option>
                  <option value="No aplica">No aplica</option>
                  <option value="No Recursos propios">Recursos propios</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Madre cabeza de familia (opcional)</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="MadreCabFamiliaAlum" name="MadreCabFamilia">    
                  <option class="hidden">Selecciona una opción</option>                                
                  <option value="Si">Si</option>
                  <option value="No">No</option>                                    
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Hijo de cabeza de familia (opcional)</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="HijoDeMadreCabFamiliaAlum" name="HijoDeMadreCabFamilia">                                
                  <option class="hidden">Selecciona una opción</option>                                
                  <option value="Si">Si</option>
                  <option value="No">No</option>                                    
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Beneficiario de veterano militar (opcional)</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="BeneVeteranoMilitarAlum" name="BeneVeteranoMilitar">
                  <option class="hidden">Selecciona una opción</option>                                
                  <option value="Si">Si</option>
                  <option value="No">No</option>                                    
              </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Beneficiario de heroe nacional (opcional)</label>
            <div class="col-md-9">
              <select class="form-control m-bot15" id="BeneHeroeNacionalAlum" name="BeneHeroeNacional">
                <option class="hidden">Selecciona una opción</option>                                
                <option value="Si">Si</option>
                <option value="No">No</option>                                    
              </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Población victima (opcional)</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdVictimaAlum" name="IdVictima">
                  @if($tipovictimas->count())
                    @foreach($tipovictimas as $tipovictima)
                        <option value="{{ $tipovictima->IdVictima }}">{{ $tipovictima->NombreTipoVictima }}</option>
                    @endforeach
                  @endif
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="timesheetinput3">Fecha de expulsión (opcional)</label>
            <div class="col-md-9">
                <div class="position-relative has-icon-left">
                    {!! Form::date('FechaExpulsion', null, ['id'=>'FechaExpulAlum','placeholder'=>'01/01/2011', 'class'=> 'form-control']) !!}
                    <div class="form-control-position">
                        <i class="la la-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Departameno expulsor (opcional)</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdDepartamentoExpAlum" name="IdDepartamento">
                  @if($departamentos->count())
                  <option value="" hidden>Seleccionar Departamento de expulsión</option>
                    @foreach($departamentos as $departamento)
                        <option value="{{ $departamento->IdDepartamento }}">{{ $departamento->NombreDepartamento }}</option>
                    @endforeach
                  @endif
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Municipio expulsor (opcional)</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdMunicipioExpAlum" name="IdMunicipio">
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Resguardo (opcional)</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdResguardoAlum" name="IdResguardo">
                  @if($resguardos->count())
                    @foreach($resguardos as $resguardo)
                        <option value="{{ $resguardo->IdResguardos }}">{{ $resguardo->NombreResguardo }}</option>
                    @endforeach
                  @endif
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Etnia (opcional)</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdEtniaAlum" name="IdEtnia">
                  @if($etnias->count())
                    @foreach($etnias as $etnia)
                        <option value="{{ $etnia->IdEtnias }}">{{ $etnia->NombreEtnia }}</option>
                    @endforeach
                  @endif
                </select>
            </div>
        </div>

    </div>

</div>

<div class="tab-pane" id="linkOpt3" role="tabpanel" aria-labelledby="linkOpt-tab3" aria-expanded="false">

    <div class="form-body">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary pull-right col-md-3" title="Segundo acudiente" data-toggle="modal" data-target="#SegundoAcudiente"><i class="fas fa-users"></i> Segundo Acudiente</button>
            <h4 class="form-section col-md-5"><i class="la la-user"></i> Información acudiente</h4>                                                              
          </div>   
          <br>     
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Tipo Acudiente *</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdTipoAcudiente" name="IdTipoAcudiente">
                  @if($tipoacudiente->count())
                      <option class="hidden" value="">Selecciona una opción</option>
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
                {!! Form::text('PrimerNombreAcu', null, ['id'=>'PrimNombAcu','placeholder'=>'Ingrese su primer nombre', 'class'=> 'form-control valletras']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Segundo nombre</label>
            <div class="col-md-9">
                {!! Form::text('SegundoNombreAcu', null, ['id'=>'SeguNombAcu','placeholder'=>'Ingrese su segundo nombre', 'class'=> 'form-control valletras']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput2">Primer apellido *</label>
            <div class="col-md-9">
                {!! Form::text('PrimerApellidoAcu', null, ['id'=>'PriApellAcu','placeholder'=>'Ingrese su primer apellido', 'class'=> 'form-control vallel']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput2">Segundo apellido *</label>
            <div class="col-md-9">
                {!! Form::text('SegundoApellidoAcu', null, ['id'=>'SeguApellAcu','placeholder'=>'Ingrese su segundo apellido', 'class'=> 'form-control vallel']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput3">E-mail *</label>
            <div class="col-md-9">
                {!! Form::email('CorreoAcu', null, ['id'=>'EmailAcu','placeholder'=>'example@example.com', 'class'=> 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Parentesco *</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdParentescoAcu" name="IdParentesco">
                  @if($parentescos->count())
                      <option class="hidden" value="">Selecciona una opción</option>
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
                {!! Form::textarea('DireccionHogar', null, ['id'=>'DirHogAcu','placeholder'=>'Ingrese la dirección de su residencia', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput4">Telefono hogar (opcional)</label>
            <div class="col-md-9">
                {!! Form::text('TelefonoHogar', null, ['id'=>'TelHogAcu', 'placeholder'=>'Ingrese su numero de telefono del hogar', 'class'=> 'form-control valalfanumericoespace']) !!}
            </div>
        </div>
        <div class="form-group row last">
            <label class="col-md-3 label-control" for="projectinput9">Dirección trabajo (opcional)</label>
            <div class="col-md-9">
                {!! Form::textarea('DireccionTrabajo', null, ['id'=>'DirTraAcu','placeholder'=>'Ingrese la dirección de su trabajo', 'class'=> 'form-control', 'style'=>'height:150px']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput4">Telefono trabajo (opcional)</label>
            <div class="col-md-9">
                {!! Form::text('TelefonoTrabajo', null, ['id'=>'TelTraAcu','placeholder'=>'Ingrese su numero de telefono del trabajo', 'class'=> 'form-control valalfanumericoespace']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput4">Telefono personal *</label>
            <div class="col-md-9">
                {!! Form::text('TelefonoCelular', null, ['id'=>'TelPerAcu','placeholder'=>'Ingrese su numero de telefono de celular', 'class'=> 'form-control valalfanumericoespace']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput4">Ocupación (opcional)</label>
            <div class="col-md-9">
                {!! Form::text('Ocupacion', null, ['id'=>'OcupAcu','placeholder'=>'Ingrese su ocupación laboral', 'class'=> 'form-control vallel']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Tipo documento *</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdTipoDocumentoAcu" name="IdTipoDocumento">
                  @if ($tipodocumentos->count())
                      <option class="hidden" value="">Selecciona una opción</option>
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
                {!! Form::text('NumeroDocumentoAcu', null, ['id'=>'NumDocuAcu','placeholder'=>'Ingrese su numero de documento', 'class'=> 'form-control valnum']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Departamento expedición *</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdDepartamentoExpAcu" name="IdDepartamento">
                  @if ($departamentos->count())
                      <option class="hidden" value="">Selecciona una opción</option>
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
                <select class="form-control m-bot15" id="IdMunicipioExpedicionAcu" name="IdMunicipioExpedicion"></select>
            </div>
        </div>
    </div>
</div>


<div class="tab-pane" id="linkOpt4" role="tabpanel" aria-labelledby="linkOpt-tab4" aria-expanded="false">
    <div class="form-body">
        <h4 class="form-section"><i class="la la-user"></i> Información académica</h4>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Grado *</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="IdGradoIfAca" name="IdGrado">
                  @if($grados->count())
                      <option class="hidden">Selecciona una opción</option>
                      @foreach($grados as $grado)
                          <option value="{{ $grado->IdGrado }}">{{ $grado->NombreGrado }}</option>
                      @endforeach
                  @endif
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Valor pension (opcional)</label>
            <div class="col-md-9">
                {!! Form::text('valorPension', null, ['id'=>'ValPensIfAca','placeholder'=>'Ingrese el valor de la pensión', 'class'=> 'form-control valpesos']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Valor matrícula (opcional)</label>
            <div class="col-md-9">
                {!! Form::text('valorMatricula', null, ['id'=>'valorMatricula','placeholder'=>'Ingrese el valor de la matrícula', 'class'=> 'form-control valpesos']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput2">Numero de lista actual *</label>
            <div class="col-md-9">
                {!! Form::text('Numerolista', null, ['id'=>'NumLisAca','placeholder'=>'Ingrese el numero de lista actual', 'class'=> 'form-control', 'readonly']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Estado *</label>
            <div class="col-md-9">
                <select class="form-control m-bot15" id="EstadoAca" name="Estado">                                
                                    <option class="hidden">Selecciona una opción</option>                                    
                                    <option value="ACTIVO">ACTIVO</option>  
                                    <option value="RETIRADO">RETIRADO</option>  
                                    <option value="TRASLADADO">TRASLADADO</option>  
                                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="timesheetinput3">Fecha de estado *</label>
            <div class="col-md-9">
                <div class="position-relative has-icon-left">
                    {!! Form::date('FechaEstado', null, ['id'=>'FechEstaAca','placeholder'=>'01/01/2011', 'class'=> 'form-control']) !!}
                    <div class="form-control-position">
                        <i class="la la-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput2">Código interno *</label>
            <div class="col-md-9">
                {!! Form::text('CodigoInterno', null, ['id'=>'CodigAca','placeholder'=>'Ingrese su codigo', 'class'=> 'form-control', 'readonly']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput3">Número matrícula *</label>
            <div class="col-md-9">
                {!! Form::text('NumeroMatricula', null, ['id'=>'NumMatrAca','placeholder'=>'Ingrese el numero de su matrícula', 'class'=> 'form-control', 'readonly']) !!}
            </div>
        </div>

        <div class="form-group row last">
            <label class="col-md-3 label-control" for="projectinput9">Institución de origen *</label>
            <div class="col-md-9">
                {!! Form::text('InstitucionOrigen', null, ['id'=>'InstOrigAca','placeholder'=>'Ingrese el nombre de su anterior institución', 'class'=> 'form-control vallel', 'style'=>'height:150px']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput4">Estado academico anterior *</label>
            <div class="col-md-9">
                {!! Form::text('EstadoAcademicoAnterior', null, ['id'=>'EstaAcaAnte','placeholder'=>'Ingrese su estado academico anterior', 'class'=> 'form-control vallel']) !!}
            </div>
        </div>
        <div class="form-group row last">
            <label class="col-md-3 label-control" for="projectinput9">Estado matricula final *</label>
            <div class="col-md-9">
                {!! Form::text('EstadoMatriculaFinal', null, ['id'=>'EstaMatrFinAca','placeholder'=>'Ingrese su estado de matrícula final', 'class'=> 'form-control vallel', 'style'=>'height:150px']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput4">Condición fin de año (opcional)</label>
            <div class="col-md-9">
                {!! Form::text('CondicionFinAno', null, ['id'=>'CondiFinAnoAca','placeholder'=>'Ingrese su condición', 'class'=> 'form-control vallel']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput4">Causa traslado (opcional)</label>
            <div class="col-md-9">
                {!! Form::text('CausaTraslado', null, ['id'=>'CausTrasAca','placeholder'=>'Ingrese su motivo de traslado', 'class'=> 'form-control vallel']) !!}
            </div>
        </div>
    </div>
</div>

<div class="form-actions">
    <a href="{{ route('alumno') }}" class="btn btn-warning mr-1">
        <i class="la la-remove"></i> Cancelar
    </a>
    <button type="button" onclick="GuardarAlumno()" class="btn btn-primary">
      <i class="la la-check"></i> Guardar
    </button>
</div>
{!! Form::close() !!}
</div>
