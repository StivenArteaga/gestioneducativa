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

<section id="secretaria">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <button class="btn btn-success">
               <a data-toggle="modal" data-target=".bd-example-modal-lg">Nueva Secretaria</a>
            </button>
                
            
            <div class="text-center">
              <h1 class="card-title">Listado de secretarias</h1>
            </div>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3" ></i></a>                  
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
                    <th>Nombre Secretaria</th>
                    <th>Numero Documento</th>
                    <th>Numero Telefono</th>                    
                    <th>Correo</th>
                    <th>Sede</th>
                    <th with="300px">Acción</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($secretaria as $secretaria)
                      <tr>                                
                          <td>{{ $secretaria->PrimerNombreSecretaria }} {{ $secretaria->PrimerApellidoSecretaria }}  {{ $secretaria->SegundoApellidoSecretaria }}</td>
                          <td>{{ $secretaria->NumeroDocumentoSecretaria }}</td>      
                          <td>{{ $secretaria->TelefonoSecretaria }}</td>      
                          <td>{{ $secretaria->CorreoSecretaria }}</td>
                          <td>{{ $secretaria->NombreSede }}</td>                    
                          <td>                                       
                            <button type="button" title="Editar Registro" class="btn icon-table" onclick="editSecretaria({{ $secretaria->IdSecretaria }})" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="far far fa-edit"></i></button>
                          {!! Form::open([ 'url'=>['secretaria', $secretaria->IdSecretaria], 'method' => 'DELETE','style'=> 'display:inline' ]) !!}                                                            
                            <button type="submit" title="Eliminar Registro"  class="btn icon-table"><i class="far fa-trash-alt icon-size"></i></a></button>
                          {!! Form::close() !!}               
                          </td>
                      </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>                        
                    <th>Nombre Secretaria</th>
                    <th>Numero Documento</th>
                    <th>Numero Telefono</th>                    
                    <th>Correo</th>
                    <th>Sede</th>
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
                    <h2 class="card-title">REGISTRO DE SECRETARIA</h2>
                  </div>
               <div class="card-content">
                  <div class="card-body">   
                  {!! Form::open(['route' => 'secretaria.store', 'method' => 'POST']) !!}    
                      <form class="form form-horizontal row-separator">
                          <div class="form-body">
                              <h4 class="form-section"><i class="la la-user"></i> Información de secretaria</h4>
                                 <div class="form-group row">
                                  <label class="col-md-3 label-control" for="projectinput6">Sede *</label>
                                    <div class="col-md-9">                                                        
                                      <select class="form-control m-bot15" id="IdSede" name="IdSede">
                                      @if($sedes->count())
                                        <option class="hidden">Selecciona una opción</option>
                                      @foreach($sedes as $sedes)
                                        <option value="{{ $sedes->IdSede }}">{{ $sedes->NombreSede }}</option>
                                      @endforeach
                                    @endif
                                      </select>
                                    </div>
                                  </div>                                
                                  <div class="form-group row">
                                      <label class="col-md-3 label-control" for="projectinput1">Primer Nombre *</label>
                                          <div class="col-md-9">                                            
                                              <input type="text" class="hidden">
                                                  {!! Form::text('PrimerNombreSecretaria', null, ['id'=>'PrimerNombreSecretaria','placeholder'=>'Ingrese el nombre de la secretaria', 'class'=> 'form-control']) !!}
                                                  {!! Form::text('IdSecretaria', null, ['id'=>'IdSecretaria', 'class'=> 'hidden']) !!}
                                                  {!! Form::text('EstadoSecretaria', 1, ['class'=>'hidden']) !!}
                                           </div>
                                  </div>   
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Segundo Nombre (Opcional)</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                                {!! Form::text('SegundoNombreSecretaria', null, ['id'=>'SegundoNombreSecretaria','placeholder'=>'Ingrese el nombre de la secretaria', 'class'=> 'form-control']) !!}                                            
                                         </div>
                                  </div>        
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Primer Apellido *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                                {!! Form::text('PrimerApellidoSecretaria', null, ['id'=>'PrimerApellidoSecretaria','placeholder'=>'Ingrese el apellido de la secretaria', 'class'=> 'form-control']) !!}                                            
                                         </div>
                                  </div>      
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Segundo Apellido *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                                {!! Form::text('SegundoApellidoSecretaria', null, ['id'=>'SegundoApellidoSecretaria','placeholder'=>'Ingrese el apellido de la secretaria', 'class'=> 'form-control']) !!}                                            
                                         </div>
                                  </div>    
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput6">Tipo Documento *</label>
                                      <div class="col-md-9">                                                        
                                        <select class="form-control m-bot15" id="IdTipoDocumento" name="IdTipoDocumento">
                                        @if($tipodocumentos->count())
                                          <option class="hidden">Selecciona una opción</option>
                                        @foreach($tipodocumentos as $tipodocumentos)
                                          <option value="{{ $tipodocumentos->IdTipoDocumento }}">{{ $tipodocumentos->NombreTipoDocumento }}</option>
                                        @endforeach
                                      @endif
                                        </select>
                                      </div>
                                    </div>  
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Numero Documento *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                                {!! Form::text('NumeroDocumentoSecretaria', null, ['id'=>'NumeroDocumentoSecretaria','placeholder'=>'Ingrese el numero de documento de la secretaria', 'class'=> 'form-control']) !!}                                            
                                         </div>
                                  </div>     
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Dirección *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                                {!! Form::text('DireccionSecretaria', null, ['id'=>'DireccionSecretaria','placeholder'=>'Ingrese la dirección de la secretaria', 'class'=> 'form-control']) !!}                                            
                                         </div>
                                  </div>   
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Correo *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                                {!! Form::text('CorreoSecretaria', null, ['id'=>'CorreoSecretaria','placeholder'=>'Ingrese el correo de la secretaria', 'class'=> 'form-control']) !!}                                            
                                         </div>
                                  </div>  
                                  <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Telefono *</label>
                                        <div class="col-md-9">                                            
                                            <input type="text" class="hidden">
                                                {!! Form::text('TelefonoSecretaria', null, ['id'=>'TelefonoSecretaria','placeholder'=>'Ingrese el telefono de la secretaria', 'class'=> 'form-control']) !!}                                            
                                         </div>
                                  </div>                     
                          </div>                                                                 
                              <div class="form-actions">
                                  <a href="{{ route('secretarias') }}" class="btn btn-warning mr-1">
                                      <i class="la la-remove"></i> Cancelar
                                  </a>
                                  <button type="submit" class="btn btn-primary">
                                      <i class="la la-check"></i> Guardar
                                  </button>
                              </div> 
                          </div>    
                      </form>                   
                  {!! Form::close() !!} 
                  </div>
              </div>
          </div>            
  
      </div>
    </div>
  </div>


@endsection

@section('script')
 <script>
    
 </script>   
@endsection