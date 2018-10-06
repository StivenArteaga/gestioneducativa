(function(window, undefined) {
  'use strict';  

})(window);

function MostrarMateria(id) 
{
    $.get('updmat/updmat/'+id, function(data){        
        if (data != null) {
            $("#IdMateria").val(data.IdMateria);
            $("#NombreMateria").val(data.NombreMateria);
            $("#IdAreaMat").val(data.IdArea);
            $("#DescripcionMateria").val(data.DescripcionMateria);
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
        
    });   
}  

function Mostrar(id)
{    
    $.get('editalum/editalum/'+id, function(data){      
        console.log(data.aulas);
          if (data.alumno != null) {       
              
              /*Datos personales del alumno*/     
              $("#IdAlumno").val(data.alumno.IdAlumno);            
              $("#PNombreA").val(data.alumno.PrimerNombre);
              $("#SNombreAlum").val(data.alumno.SegundoNombre);
              $("#PApellidoAlum").val(data.alumno.PrimerApellido);
              $("#SApellidoAlum").val(data.alumno.SegundoApellido);
              $("#CorreoAlum").val(data.alumno.Correo);
              $("#TipoDocumenAlum").val(data.alumno.IdTipoDocumento);
              $("#NDocumentAlum").val(data.alumno.NumeroDocumento);
              $("#DeparExpAlum").val(data.departamento.IdDepartamento);
              $("#IdMunicipioExpedido").val(data.alumno.IdMunicipioExpedido);
              $("#GenerAlum").val(data.alumno.IdGenero);
              $("#FechaNacAlum").val(data.alumno.FechaNacimiento);
              $("#DeparNacAlum").val(data.departamento2.IdDepartamento);
              $("#CiudNaciAlum").val(data.alumno.IdCiudadNacimiento);
              $("#DirecAlum").val(data.alumno.Direccion);
              $("#ZonaAlum").val(data.alumno.Zona);
              $("#NumContatAlum").val(data.alumno.Telefono);
              $("#DeparResidAlum").val(data.departamento3.IdDepartamento);
              $("#CiudResAlum").val(data.alumno.IdCiudadResidencia);
              /*Datos de salud del alumno*/
              $("#IdEps").val(data.salud.IdEps);
              $("#IpsAlum").val(data.salud.Ips);
              $("#IdTipoSangreAlum").val(data.salud.IdTipoSangre);
              $("#ArsAlum").val(data.salud.Ars);
              $("#NumCarnetAlum").val(data.salud.CarnetSisben);
              $("#PunSisAlum").val(data.salud.PuntajeSisben);
              $("#EstraroAlum").val(data.salud.Estrato);
              $("#FuenteRecursosAlum").val(data.salud.FuenteRecursos);
              $("#MadreCabFamiliaAlum").val(data.salud.MadreCabFamilia);
              $("#HijoDeMadreCabFamiliaAlum").val(data.salud.HijoDeMadreCabFamilia);
              $("#BeneVeteranoMilitarAlum").val(data.salud.BeneVeteranoMilitar);
              $("#BeneHeroeNacionalAlum").val(data.salud.BeneHeroeNacional);
              $("#IdVictimaAlum").val(data.salud.IdVictima);
              $("#FechaExpulAlum").val(data.salud.FechaExpulsion);
              $("#IdDepartamentoExpAlum").val(data.departamento4.IdDepartamento);
              $("#IdMunicipioExpAlum").val(data.salud.IdMunicipio);
              $("#IdResguardoAlum").val(data.salud.IdResguardo);
              $("#IdEtniaAlum").val(data.salud.IdEtnia);
              /*Datos acudiente*/
              $("#IdTipoAcudiente").val(data.detallealumacu.IdTipoAcudiente);
              $("#PrimNombAcu").val(data.acudiente.PrimerNombreAcu);
              $("#SeguNombAcu").val(data.acudiente.SegundoApellidoAcu);
              $("#PriApellAcu").val(data.acudiente.PrimerApellidoAcu);
              $("#SeguApellAcu").val(data.acudiente.SegundoApellidoAcu);
              $("#EmailAcu").val(data.acudiente.CorreoAcu);
              $("#IdParentescoAcu").val(data.acudiente.IdParentesco);
              $("#DirHogAcu").val(data.acudiente.DireccionHogar);
              $("#TelHogAcu").val(data.acudiente.TelefonoHogar);
              $("#DirTraAcu").val(data.acudiente.DireccionTrabajo);
              $("#TelTraAcu").val(data.acudiente.TelefonoTrabajo);
              $("#TelPerAcu").val(data.acudiente.TelefonoCelular);
              $("#OcupAcu").val(data.acudiente.Ocupacion);
              $("#IdTipoDocumentoAcu").val(data.acudiente.IdTipoDocumento);
              $("#NumDocuAcu").val(data.acudiente.NumeroDocumentoAcu);
              $("#IdDepartamentoExpAcu").val(data.departamento5.IdDepartamento);
              $("#IdMunicipioExpedicionAcu").val(data.acudiente.IdMunicipioExpedicion);

              /*Detalle alumno acudiente */
               $("#IdTipoAcudiente").val(data.detallealumacu.IdTipoAcudiente);
            
              /*Datos de la información academica del alumno */
              $("#IdGradoIfAca").val(data.academica.IdGrado);
              
              $("#ValPensIfAca").val(data.academica.valorPension);
              $("#valorMatricula").val(data.academica.valorMatricula);
              $("#NumLisAca").val(data.academica.Numerolista);
              $("#EstadoAca").val(data.academica.Estado);
              $("#FechEstaAca").val(data.academica.FechaEstado);
              $("#CodigAca").val(data.academica.CodigoInterno);
              $("#NumMatrAca").val(data.academica.Numerolista);
              $("#InstOrigAca").val(data.academica.InstitucionOrigen);
              $("#EstaAcaAnte").val(data.academica.EstadoAcademicoAnterior);
              $("#EstaMatrFinAca").val(data.academica.EstadoMatriculaFinal);
              $("#CondiFinAnoAca").val(data.academica.CondicionFinAno);
              $("#CausTrasAca").val(data.academica.CausaTraslado);

            }else{
              alert('Error al cargar los datos, verifica el proceso de editar');
          }     
      });
}

function MostrarArea(id) {
    $.get('edit/edit/'+id, function(data){
        if (data!= null) {
            /*Dato del area */
            $("#IdArea").val(data.IdArea);
            $("#NombreArea").val(data.NombreArea);
            $("#DescripcionArea").val(data.DescripcionArea);
        }else{
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}

function MostrarMaestro(id) {
    $.get('updmae/updmae/'+ id, function(data){
         if (data != null) {
             $("#IdAsignatura").val(data.IdAsignatura);
             $("#PNombreMaes").val(data.PrimerNombreMaes);
             $("#SNombreMaes").val(data.SegundoNombreMaes);
             $("#PApellidoMaes").val(data.PrimerApellidoMaes);
             $("#SApellidoMaes").val(data.SegundoApellidoMaes);
             $("#IdTipoDocumentoMaes").val(data.IdTipoDocumento);
             $("#NumeDocumenMaes").val(data.NumeroDocumento);
             $("#FechaNaciMaes").val(data.FechaNacimiento);
             $("#IdGeneroMaes").val(data.IdGenero);
             $("#IdTipoSangMaes").val(data.IdTipoSangre);
             $("#CorreoMaes").val(data.Correo);
             $("#DireccionMaes").val(data.Direccion);
             $("#NumerContactMaes").val(data.Telefono);
             $("#IdCiudadOrigMaes").val(data.IdCiudad);
             $("#EspeciaMaes").val(data.Especializacion);
             $("#EscalafonMaes").val(data.Escalafon);
             $("#CoordinadorMaes").val(data.Coordinador);
             $("#IdMaestro").val(data.IdMaestro);             
         } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
         }   
    });
}

function MostrarAsignatura(id) {
    $.get('updasi/updasi/'+id, function(data){
        if (data != null) {            
            $("#IdAsignatura").val(data.IdAsignatura);      
            $("#NombreAsignatura").val(data.NombreAsignatura);
            $("#IdMateriaAsig").val(data.IdMateria);            
            $("#IdTipoAsignaturaAsig").val(data.IdTipoAsignatura);
            $("#DescripcionAsignatura").val(data.DescripcionAsignatura);
            $("#Intensidad").val(data.Intensidad);
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });    
}

function MostrarLogro(id) {    
    $.get('updlog/updlog/'+id, function(data){
        if (data != null) { 
            $("#DescripLogro").val(data.DescripcionLogro);
            $("#IdLogro").val(data.IdLogro);
            $("#IdAsignatura").val(data.IdAsignatura);
            $("#IdPeriodo").val(data.IdPeriodo);
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}


function MostrarSede(id){    
    $.get('updsed/updsed/'+id, function(data){
        if (data != null) {
            $("#IdSede").val(data.IdSede);
            $("#NombreSede").val(data.NombreSede);
            $("#IdInstitucion").val(data.IdInstitucion);            
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}

function MostrarJornada(id){    
    $.get('uptjor/uptjor/'+id, function(data){
        if (data != null) {
            $("#IdJornada").val(data.IdJornada);
            $("#NombreJornada").val(data.NombreJornada);
            $("#HoraInicio").val(data.HoraInicio);
            $("#HoraFin").val(data.HoraFin);
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}


function MostrarGrado(id){
    $.get('updgra/updgra/'+id, function(data){
        if (data != null) {
            $("#IdGrado").val(data.IdGrado);
            $("#NombreGrado").val(data.NombreGrado);
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}


function MostrarAula(id){
    $.get('updaul/updaul/'+id, function(data){
        if (data != null) {
            $("#IdSalon").val(data.IdSalon);
            $("#IdSede").val(data.IdSede);
            $("#NombreSalon").val(data.NombreSalon);
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}

function MostrarGrupo(id){
    $.get('updgrup/updgrup/'+id, function(data){
        if (data != null) {
            
            $("#IdGrupo").val(data.grupos.IdGrupo);
            $("#IdTipoCalendario").val(data.grupos.IdTipoCalendario);
            $("#IdSalon").val(data.grupos.IdSalon);
            $("#IdGrado").val(data.grupos.IdGrado);
            $("#IdJornada").val(data.grupos.IdJornada);
            $select = $("#IdGrado");
            $select.trigger('change');
            listarAlum();            
        
            $('#TAsign td').each(function() {                
               //console.log(index)
                var valores ='';
                valores = $(this).parents("tr").find("td").eq(0).html();                
                //console.log(data.Asignaturas.IdAsignatura,valores );
                
                data.Asignaturas.forEach(function(e){                                            
                    var parametro = $("input[name='checkAignatura']");
                    for (let index = 0; index < parametro.length; index++) {                            
                            if(e.IdAsignatura == valores){                        
                                $('#checkAignatura_'+e.IdAsignatura).attr('checked', true);                                   
                                break;
                            }
                    }                                        
                });
                
            });   
            SelectAlum();
            SelectAsig();         
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}

function DetalleArea(id){
    $.get('detallarea/'+id, function(data){
        if (data != null) {           
            var valor = ''
            data.forEach(data => {
              valor += "<tr>"+               
               "<td>" + data.NombreMateria + "</td>"+               
               "<tr>";
            })
            $("#IdTableBodyDetalleArea").html(valor);
        } else {
            alert('Error al cargar los datos, verifica el proceso de detalle');
        }
    });
}

function DetalleMateria(id){
    $.get('detallemat/'+id, function(data){
        if (data != null) {
            var valor1 = ''
            data.forEach(data => {
                valor1 += "<tr>"+               
               "<td>" + data.NombreAsignatura + "</td>"+               
               "<tr>";
            })
            $("#IdTBodyDetalleMateria").html(valor1);
        } else {
            alert('Error al cargar los datos, verifica el proceso de detalle');
        }
    });
}

function DetalleAsignatura(id){
    $.get('detalleasig/'+id, function(data){
        if (data != null) {
            var valor2 = ''
            data.forEach(data => {
                valor2 += "<tr>"+               
               "<td>" + data.DescripcionLogro + "</td>"+               
               "<tr>";
            })
            $("#IdTBodyDetalleAsignatura").html(valor2);
        } else {
            alert('Error al cargar los datos, verifica el proceso de detalle');
        }
    });
}

function listarAlum(){      
    var Id = $("#IdGrado").val();
    $.get('listalum/listalum/'+Id, function (data){
        if (data != null) {
            var valor3 = ''
            data.forEach(data => {
                valor3 += "<tr>"+               
               "<td class='hidden'>" + data.IdAlumno + "</td>"+               
               "<td class='hidden'>" + "<input type='checkbox' name="+data.IdAlumno+" id='acheckbox' class='form-check-input check'></input>" + "</td>" +  
               "<td>" + data.NumeroDocumento + "</td>"+               
               "<td>" + data.PrimerNombre + " "+ data.SegundoNombre+ " " + data.PrimerApellido+" "+data.SegundoApellido + "</td>"+               
               "<tr>";
            })
            $("#IdTBodyListAlumn").html(valor3);            
        } else {
            alert('Error al cargar los datos, verifica el proceso de listar los alumnos de acuerdo al grado');
        }
    });
}

function SelectAlum(){         
    $("#IdTBodyListAlumn input:checkbox").each(function() {                
        $(this).prop('checked',true);
        var selected = new Array();                              
        selected.push($(this).parent().parent().find('td').eq(0).html()); 
        $("#data").append(
            '<input type="hidden" name="IdAlumno[]" value="'+selected+'">'
        )
    });    
}


function SelectAsig(){            
    $("#TAsign input:checkbox:checked").each(function() {        
        var selectedAsig = new Array();                              
        selectedAsig.push($(this).parent().parent().find('td').eq(0).html());  
        $("#data1").append(
            '<input type="hidden" name="IdAsignatura[]" value="'+selectedAsig+'">'
        )
    });    
}

function SelectAsig1(){
    $("#data1").empty();
    console.log($('#data1').val());
    SelectAsig();
}

function listAlumMatr(id){
    $.get('lismat/lismat/'+id, function(data){   
        console.log(data[0].IdGrado);     
        if (data != null) {
            $("#IdMatricula").val(data[0].IdMatricula);
            $("#IdAlumnoName").val(data[0].IdAlumno);
            $("#IdGradoName").val(data[0].IdGrado);
            $("#valorMatricula").val(data[0].valorMatricula);
        } else {
            alert('Error al cargar los datos, verifica el proceso de listar los datos de la matricula');
        }
    });
}

function AsignaNumerAuto(){
    $.get('autoincre/', function(data){
            if (data != null) {
                   $("#NumMatrAca").val(data.numMatricula);             
                   $("#CodigAca").val(data.codigo);
            } else {
                alert('Error al cargar los datos del numero de la matricula, lista y codigo interno');
            }
    });
}


$("#IdGradoIfAca").change(function(){
    var Id = $("#IdGradoIfAca").val();
    $.get('listalum/'+Id, function (data){
        console.log(data);
        if (data != null) {
            $("#NumLisAca").val(data);
        } else {
            alert('Error al cargar los datos del numero del numero de lista del alumno');
        }
    });
});