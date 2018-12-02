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
                    <div class="form-group row">                        
                            <div class="col-md-6">                                                        
                            <label class="col-md-6 label-control" for="projectinput6">Filtro por grado</label>
                               <select class="form-control m-bot15 target" id="IdGradoEv" name="IdGrado">
                                @if($grados->count())
                                    <option class="hidden">Selecciona una opción</option>
                                @foreach($grados as $grado)
                                    <option value="{{ $grado->IdGrado }}">{{ $grado->NombreGrado }}</option>
                                @endforeach
                                @endif
                                </select>
                            </div>
                    </div>
                      
                  
                  <div class="text-center">
                    <h1 class="card-title">Listado de asignatura</h1>
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
                          <th>Asignatura</th>                                                  
                          <th with="300px">Evaluar</th>
                        </tr>
                      </thead>
                      <tbody id="TblAsignaturaEvaluBody">                      
                            
                      </tbody>
                      <tfoot>
                        <tr>                        
                          <th>Asignatura</th>                                                                             
                          <th>Evaluar</th>
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
    <div class="modal-content" style="width: 130%;">

            
              <div class="card">                  
                  <div class="card-content">
                      <div class="card-body">   
                      <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">                                                      
                        
                        <div class="text-center">
                          <h1 class="card-title">EVALUACIÓN DE ALUMNOS POR ASIGNATURAS</h1>
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
                                <th with="30px">N° lista</th>                                                  
                                <th>Nombre</th>
                                <th with="700px">1° Periodo  <input type="checkbox" id="chekPeriodoUno" title="Al seleccionar este icono podras consultar los logros de este periodo"></th>
                                <th with="700px">2° Periodo  <input type="checkbox" id="chekPeriodoDos" title="Al seleccionar este icono podras consultar los logros de este periodo"></th>
                                <th with="700px">3° Periodo  <input type="checkbox" id="chekPeriodoTres" title="Al seleccionar este icono podras consultar los logros de este periodo"></th>
                                <th with="700px">4° Periodo  <input type="checkbox" id="chekPeriodoCuatro" title="Al seleccionar este icono podras consultar los logros de este periodo"></th>
                                <th with="300px">Acción</th>
                              </tr>                              
                            </thead>
                            <tbody id="TblListAlumEval">                                                             
                            @if($grados->count())                                    
                                @foreach($alumnos as $alumnos)
                                <tr>
                                    <td class='hidden'>{{$alumnos.IdAlumno}}</td>                                       
                                    <td>{{$alumnos.Numerolista}}  </td>                                     
                                    <td>{{$alumnos.PrimerNombre }}   {{$alumnos.SegundoNombre}} {{$alumnos.PrimerApellido}} {{$alumnos.SegundoApellido}}</td>                              
                                    <td class='numero'>  
                                        <select name='IdNota[]' id='IdNotaPeri1' class='form-control asigarnota' style='height:25px;'>
                                              <option disabled='disabled' selected>Selecciona una opción...</option>                            
                                        </select> 
                                        <button class='btn btn-success' id='notaFinal' onclick='evalAumno(idAsignatura,alumnos.IdAlumno,1)' style='height:35px;' >Evaluar</button>
                                  </td>               
                                  <td class='numero'>  
                                        <select name='IdNota[]' id='IdNotaPeri2' class='form-control asigarnota2' style='height:25px;'>
                                              <option disabled='disabled' selected>Selecciona una opcion...</option>                                                    
                                        </select> 
                                        <button class='btn btn-success' id='notaFinal' onclick='evalAumno(idAsignatura,alumnos.IdAlumno,2)' style='height:35px;' >Evaluar</button>
                                  </td>               
                                  <td class='numero'>  
                                        <select name='IdNota[]' id='IdNotaPeri3'class='form-control asigarnota3' style='height:25px;'>
                                              <option disabled='disabled' selected>Selecciona una opcion...</option>                                                    
                                        </select> 
                                        <button class='btn btn-success' id='notaFinal' onclick='evalAumno(idAsignatura,alumnos.IdAlumno,3)' style='height:35px;' >Evaluar</button>
                                  </td>               
                                  <td class='numero'>  
                                        <select name='IdNota[]' id='IdNotaPeri4' class='form-control asigarnota4' style='height:25px;'>
                                              <option disabled='disabled' selected>Selecciona una opcion...</option>                                                
                                        </select> 
                                        <button class='btn btn-success' id='notaFinal' onclick='evalAumno(idAsignatura,alumnos.IdAlumno,4)' style='height:35px;' >Evaluar</button>
                                  </td>   
                                  <td>                                            
                                          <a class='' href="{{ url('') }}" style='height:35px;' title='Descargar boletín'><i class='fas fa-file-download'></i></a>
                                          <button class='btn btn-warning' style='height:35px;' title='Asignar logros'><i class='fas fa-star-half-alt'></i></button>
                                  </td>            
                                </tr>   
                                @endforeach
                           @endif                                                           
                            </tbody>
                            <tfoot>
                            <tr>                          
                                <th>N° lista</th>                                                  
                                <th>Nombre</th>
                                <th>1° Periodo</th>
                                <th>2° Periodo</th>
                                <th>3° Periodo</th>
                                <th>4° Periodo</th>
                                <th>Acción</th>
                              </tr>                              
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
            </div>
        </div>            

    </div>
  </div>
</div>

<div class="modal fade" id="listadoLogro">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">LISTADO DE LOGROS POR ASIGNATURA Y PERIODO</h4>          
          <button type="button" class="close" data-dismiss="modal">&times;</button>          
        </div>
        <div style="">
            <h4>Maestro:  <label id="NombreMaestroEvaluador"></label></h4>
            <h4>Periodo:  <label id="PeriodoActual"></label></h4>
            <h4>Asignatura: <label id="AsignaturaEvaluada"></label></h4>
            <h4>Nota Final: <label id="NotaFinal"></label></h4>
        </div>
        <div id="data3"></div>
        <!-- Modal body -->
        <div class="modal-body">
        <div class="card-content collapse show">
                  <div class="card-body card-dashboard">                    
                    <table class="table table-striped table-bordered dom-jQuery-events" id="MyTableAlumn">
                      <thead>
                        <tr>                                                
                          <th>Logro</th>                          
                          <th>Descripción del logro</th>                   
                        </tr>
                      </thead>
                      <tbody id="IdBodyLogroEvaluacion">                                                                               
                        
                      </tbody>
                      <tfoot>
                        <tr>                                                    
                          <th>Logro</th>                          
                          <th>Descripción del logro</th>                    
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="SelectLogro()" data-dismiss="modal">Agregar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
</div>

@endsection

@section('script')
  <script>  
      
function ListAlum(id,idAsignatura){  
    
    $.get('listalumasig/listalumasig/'+id+'/'+idAsignatura, function(data){      
        if (data != null) {                              
            var valor5 = ''            
            data.alumnos.forEach(alumnos => {              
                valor5 += "<tr id='auto[]'>"+    
                "<td class='hidden'>" + alumnos.IdAlumno + "</td>"+                                                                    
               "<td>" + alumnos.Numerolista + "</td>"+                                     
               "<td>" + alumnos.PrimerNombre +" "+ alumnos.SegundoNombre+" "+alumnos.PrimerApellido+" "+alumnos.SegundoApellido+"</td>"+                              
               "<td class='numero'>" + 
                        "<select name='IdNota[]' id='IdNotaPeri1[]' class='form-control asigarnota asigarnotacolumna asigarnotafila' style='height:25px;'>"+
                            "<option disabled='disabled' selected>Selecciona una opción...</option>"+                            
                        "</select>" +
                        "<button class='btn btn-success' id='notaFinal' onclick='evalAumno("+idAsignatura+","+alumnos.IdAlumno+","+1+")' style='height:35px;' >Evaluar</button>"+
                "</td>"+               
                "<td class='numero'>" + "<select name='IdNota[]' id='IdNotaPeri2[]' class='form-control asigarnota2' style='height:25px;'>"+
                            "<option disabled='disabled' selected>Selecciona una opcion...</option>"+                                                    
                        "</select>" +
                        "<button class='btn btn-success' id='notaFinal' onclick='evalAumno("+idAsignatura+","+alumnos.IdAlumno+","+2+")' style='height:35px;' >Evaluar</button>"+
                "</td>"+               
                "<td class='numero'>" + "<select name='IdNota[]' id='IdNotaPeri3[]'class='form-control asigarnota3' style='height:25px;'>"+
                            "<option disabled='disabled' selected>Selecciona una opcion...</option>"+                                                    
                        "</select>" +
                        "<button class='btn btn-success' id='notaFinal' onclick='evalAumno("+idAsignatura+","+alumnos.IdAlumno+","+3+")' style='height:35px;' >Evaluar</button>"+
                "</td>"+               
                "<td class='numero'>" + "<select name='IdNota[]' id='IdNotaPeri4[]' class='form-control asigarnota4' style='height:25px;'>"+
                            "<option disabled='disabled' selected>Selecciona una opcion...</option>"+                                                
                        "</select>" +
                        "<button class='btn btn-success' id='notaFinal' onclick='evalAumno("+idAsignatura+","+alumnos.IdAlumno+","+4+")' style='height:35px;' >Evaluar</button>"+
                "</td>"+   
                "<td>"+  
                        "<a class='btn btn-info' onclick='DownloadBoletin("+alumnos.IdAlumno+","+idAsignatura+")' style='height:35px;' title='Descargar boletín' ><i class='fas fa-file-download'></i></a>"+
                        "<button class='btn btn-warning' style='height:35px;' title='Asignar logros' onclick='listalogro("+idAsignatura+','+alumnos.IdAlumno+")' ><i class='fas fa-star-half-alt'></i></button>"+
                "</td>"+            
               "<tr>";     
            });          

            $("#TblListAlumEval").html(valor5);                                        
            var array = [];                                        
            $("#TblListAlumEval select").each(function(){                
                $.each(data.notas,function(index,nota) {                                        
                    if (array.indexOf(nota.IdNota) == -1) {
                        $('select[name*=IdNota]').append('<option value='+nota.IdNota+'>'+nota.NombreNota+'</option>')                                                                     
                        array += nota.IdNota;                        
                    }                    
                });                                                                                                                  
            });            
                                            
            $("#TblListAlumEval select").each(function(val){                         
              var selected = new Array(); 
              selected.push($(this).parent().parent().find('td').eq(0).html());
              console.log(selected, data.evaluaciones);
              $.each(data.evaluaciones, function(index, value){                                                                           
                if(selected.indexOf(value.IdAlumno) == -1){
                            switch (value.IdPeriodo) {
                                case 1:                                
                                      $('select[id*=IdNotaPeri1]').val(value.NotaFinal);
                                    break;
                                case 2:
                                      $('select[id*=IdNotaPeri2]').val(value.NotaFinal);                                        
                                    break;
                                case 3:
                                      $('select[id*=IdNotaPeri3]').val(value.NotaFinal);                                        
                                    break;                                    
                                case 4:
                                      $('select[id*=IdNotaPeri4]').val(value.NotaFinal);                                         
                                    break;                            
                            }                            
                  }
              });                       
            });                                                                              

            $(".asigarnota").on('change', function(){
                $("#notaFinal").val(this.value);               
            });

            $(".asigarnota2").on('change', function(){
                $("#notaFinal").val(this.value);               
            });

            $(".asigarnota3").on('change', function(){
                $("#notaFinal").val(this.value);               
            });

            $(".asigarnota4").on('change', function(){
                $("#notaFinal").val(this.value);               
            });

        } else {
            alert('Error al cargar las asignaturas que estan asociada a este grupo con este grado');
        }
    });
}

function listalogro(IdAsignatura, IdAlumno)
{
  var a = Number($('#chekPeriodoUno').is(':checked'));
  var b = Number($('#chekPeriodoDos').is(':checked'));
  var c = Number($('#chekPeriodoTres').is(':checked'));
  var d = Number($('#chekPeriodoCuatro').is(':checked'));
  var periodo =0;
  if((a+b+c+d)>1 || (a+b+c+d)==0){    
    swal({
         type:'error',
         title: 'Upss',
         animation: true,
         customClass: 'animated tada',
        text: "Para consultar o asignar los logros de las evaluaciones, verifica tener un solo periodo seleccionado!"
      }); 
  }else{
    if (a==1) {
      periodo = 1;
    } else {
      if(b == 1){
        periodo =2;
      }else{
        if(c == 1){
          periodo = 3;
        }else{
          periodo = 4;
        }
      }
    }
    $("#listadoLogro").modal("show");
      $.get("listalog/listalog/"+IdAsignatura+'/'+IdAlumno+'/'+periodo, function(data, eval){
      if(data != null){

        if(data.status == "success"){
          var valor8 = ''
          var i=0;
          var array = [];

            data.logros.forEach(data => {                 
              if(array.length > 0){
                array.forEach(element => {
                  if(data.IdLogro == element){
                      return true;
                  }else{
                      valor8 += "<tr>"+    
                  "<td class='hidden'>"+ data.IdLogro+ "</td>"+               
                  "<td class='hidden'>"+ data.IdEvaluacion+ "</td>"+     
                  "<td class='hidden'>"+ data.EstadoLogro+ "</td>"+
                  "<td>" + "<input type='checkbox' name='chekLogro' id='chekLogro_"+data.IdLogro+"' class='form-check-input check'></input>" + "</td>" +  
                  "<td>" + data.DescripcionLogro + "</td>"+                              
                  "<tr>";            
                  }
                });
              }else{
                  valor8 += "<tr>"+    
                "<td class='hidden'>"+ data.IdLogro+ "</td>"+               
                "<td class='hidden'>"+ data.IdEvaluacion+ "</td>"+     
                "<td class='hidden'>"+ data.EstadoLogro+ "</td>"+
                "<td>" + "<input type='checkbox' name='chekLogro' id='chekLogro_"+data.IdLogro+"' class='form-check-input check'></input>" + "</td>" +  
                "<td>" + data.DescripcionLogro + "</td>"+                              
                "<tr>";            
              }                                    
              array = [data.IdLogro];                            
            })
            
            $("#IdBodyLogroEvaluacion").html(valor8); 
            $("#AsignaturaEvaluada").text(data.datos[0]);
            $("#NombreMaestroEvaluador").text(data.datos[1]);
            $("#PeriodoActual").text(data.datos[2]);
            $("#NotaFinal").text(data.datos[3]);


            //Listado de logros ya seleccionados
        if(data.arraylogrosasignados != null){
            $('#IdBodyLogroEvaluacion td').each(function() {
                  //console.log(index)
                  var valores = '';
                  valores = $(this).parents("tr").find("td").eq(0).html();
                  //console.log(data.Asignaturas.IdAsignatura,valores );

                  data.arraylogrosasignados.forEach(function(e) {
                      var parametro = $("input[name='chekLogro']");
                      for (let index = 0; index < parametro.length; index++) {
                          if (e == valores) {
                              $('#chekLogro_' + e).attr('checked', true);
                              break;
                          }
                      }
                  });

          }); 
        }


        }else{
          swal({
                type:'error',
                title: 'Upsss',
                animation: true,
                customClass: 'animated tada',
                text: data.message
              });                                                           

              var valor8 = ''
              var i=0;
            data.logros.forEach(data => {              
              valor8 += "<tr>"+    
               "<td class='hidden'>"+ data.IdLogro+ "</td>"+               
               "<td class='hidden'>"+ data.EstadoLogro+ "</td>"+     
               "<td>" + "<input type='checkbox' name="+data.IdLogro+" id='acheckbox' class='form-check-input check'></input>" + "</td>" +  
               "<td>" + data.DescripcionLogro + "</td>"+                              
               "<tr>";               
            })
            $("#IdBodyLogroEvaluacion").html(valor8);             
        }        
      }else{
          alert('Error al cargar los logros que estan asociada a esta asignatura o periodo. Ho no tiene registros asociados');
      }
      });
  }
}

function SelectLogro(){   
    SelectLogros();
} 

function SelectLogros(){
  var IdEvaluacion;
  var selectedAsig = new Array();                              
  $("#IdBodyLogroEvaluacion input:checkbox:checked").each(function() {                
        selectedAsig.push($(this).parent().parent().find('td').eq(0).html());  
        IdEvaluacion = $(this).parent().parent().find('td').eq(1).html()
        $("#data3").append(
            '<input type="hidden" name="IdLogro[]" value="'+selectedAsig+'">'
        )
    }); 

    var logros = JSON.stringify(selectedAsig);
    var eval = JSON.stringify(IdEvaluacion);     
    
    if(logros != "[]"){
      $.get("savelog/savelog/"+logros+"/"+eval, function (data){
      if(data != null){
        if (data.status == "success") {
                    swal({
                        type:'success',
                        title: 'Exito',
                        animation: true,
                        customClass: 'animated tada',
                        text: data.message
                      });                                                              
                } else {
                    swal({
                        type:'error',
                        title: 'Upsss',
                        animation: true,
                        customClass: 'animated tada',
                        text: data.message
                      });                                                           
                }                
      }else{
        swal({
                    type:'warning',
                    title: 'Upsss',
                    animation: true,
                    customClass: 'animated tada',
                    text: 'Algo salio mal, verifica en proceso, recarga la pagina y vuelve a asignar los logros!'
                  });                                        
      }
    });
    }else{  
      swal({
                    type:'warning',
                    title: 'Upsss',
                    animation: true,
                    customClass: 'animated tada',
                    text: 'No seleccionastes logros para esta evaluación!'
                  });                                        
    }

    
}

function  DownloadBoletin(alumno, asignatura) {
  var a = Number($('#chekPeriodoUno').is(':checked'));
  var b = Number($('#chekPeriodoDos').is(':checked'));
  var c = Number($('#chekPeriodoTres').is(':checked'));
  var d = Number($('#chekPeriodoCuatro').is(':checked'));
  var periodo =0;
  if((a+b+c+d)>1 || (a+b+c+d)==0){    
    swal({
         type:'error',
         title: 'Upss',
         animation: true,
         customClass: 'animated tada',
        text: "Para descargar un boletín necesita seleccionar un periodo, verifica tener un solo periodo seleccionado!"
      }); 
  }else{    
    if (a==1) {
      periodo = 1;
    } else {
      if(b == 1){
        periodo =2;
      }else{
        if(c == 1){
          periodo = 3;
        }else{
          periodo = 4;
        }
      }
    }
    location.href = "BoletinAlumno/"+alumno+'/'+asignatura+'/'+periodo;    
  }
}

  </script>  
@endsection