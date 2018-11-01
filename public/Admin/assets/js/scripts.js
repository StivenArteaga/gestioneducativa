(function(window, undefined) {
    'use strict';

})(window);

$(".dpto").change(event => {
    $.get(`/alumnos/ciudades/${event.target.value}`, function(res, sta) {
        $("#CiudNaciAlum").empty();
        $("#CiudNaciAlum").append(`<option hidden value="">Seleccionar Ciudad </option>`);
        res.forEach(element => {
            $("#CiudNaciAlum").append(`<option value=${element.IdCiudad}> ${element.NombreCiudad} </option>`);
        });
    });
});

$(".dpto").change(event => { 
    $.get(`/alumnos/municipios/${event.target.value}`, function(res, sta) {
        $(".mpio").empty();
        $(".mpio").append(`<option hidden value="">Seleccionar Municipio </option>`);
        res.forEach(element => {
            $(".mpio").append(`<option value=${element.IdMunicipio}> ${element.NombreMunicipio} </option>`);
        });
    });
});

function MostrarMateria(id) {
    $.get('updmat/updmat/' + id, function(data) {
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

function Mostrar(id) {
    $.get('editalum/editalum/' + id, function(data) {
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
            $("#SeguNombAcu").val(data.acudiente.SegundoNombreAcu);
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

        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}

function MostrarArea(id) {    
    $.get('edit/edit/' + id, function(data) {
        if (data != null) {
            /*Dato del area */
            $("#IdArea").val(data.IdArea);
            $("#NombreArea").val(data.NombreArea);
            $("#DescripcionArea").val(data.DescripcionArea);
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}

function MostrarMaestro(id) {
    $.get('updmae/updmae/' + id, function(data) {
        if (data != null) {            
            $("#PNombreMaes").val(data.maestros.PrimerNombreMaes);
            $("#SNombreMaes").val(data.maestros.SegundoNombreMaes);
            $("#PApellidoMaes").val(data.maestros.PrimerApellidoMaes);
            $("#SApellidoMaes").val(data.maestros.SegundoApellidoMaes);
            $("#IdTipoDocumentoMaes").val(data.maestros.IdTipoDocumento);
            $("#NumeDocumenMaes").val(data.maestros.NumeroDocumento);
            $("#FechaNaciMaes").val(data.maestros.FechaNacimiento);
            $("#IdGeneroMaes").val(data.maestros.IdGenero);
            $("#IdTipoSangMaes").val(data.maestros.IdTipoSangre);
            $("#CorreoMaes").val(data.maestros.Correo);
            $("#DireccionMaes").val(data.maestros.Direccion);
            $("#NumerContactMaes").val(data.maestros.Telefono);
            $("#IdCiudadOrigMaes").val(data.maestros.IdCiudad);
            $("#EspeciaMaes").val(data.maestros.Especializacion);
            $("#EscalafonMaes").val(data.maestros.Escalafon);
            $("#CoordinadorMaes").val(data.maestros.Coordinador);
            $("#IdMaestro").val(data.maestros.IdMaestro);

            $('#TAsign1 td').each(function() {
                //console.log(index)
                var valores = '';
                valores = $(this).parents("tr").find("td").eq(0).html();
                //console.log(data.Asignaturas.IdAsignatura,valores );

                data.asignaturas.forEach(function(e) {
                    var parametro = $("input[name='checkAignatura']");
                    for (let index = 0; index < parametro.length; index++) {
                        if (e.IdAsignaturaDetalleAsignaturaDocente == valores) {
                            $('#checkAignatura_' + e.IdAsignaturaDetalleAsignaturaDocente).attr('checked', true);
                            break;
                        }
                    }
                });

            });
            SelectAsig3();
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}

function MostrarAsignatura(id) {
    $.get('updasi/updasi/' + id, function(data) {
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
    $.get('updlog/updlog/' + id, function(data) {
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


function MostrarSede(id) {
    $.get('updsed/updsed/' + id, function(data) {
        if (data != null) {
            $("#IdSede").val(data.IdSede);
            $("#NombreSede").val(data.NombreSede);
            $("#IdInstitucion").val(data.IdInstitucion);
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}

function MostrarJornada(id) {
    $.get('uptjor/uptjor/' + id, function(data) {
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


function MostrarGrado(id) {
    $.get('updgra/updgra/' + id, function(data) {
        if (data != null) {
            $("#IdGrado").val(data.IdGrado);
            $("#NombreGrado").val(data.NombreGrado);
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}


function MostrarAula(id) {
    $.get('updaul/updaul/' + id, function(data) {
        if (data != null) {
            $("#IdSalon").val(data.IdSalon);
            $("#IdSede").val(data.IdSede);
            $("#NombreSalon").val(data.NombreSalon);
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}

function MostrarGrupo(id) {
    $.get('updgrup/updgrup/' + id, function(data) {
        if (data != null) {
            $("#IdTipoGrupo").val(data.grupos.IdTipoGrupo);
            $("#IdGrupo").val(data.grupos.IdGrupo);
            $("#IdTipoCalendario").val(data.grupos.IdTipoCalendario);
            $("#IdSalon").val(data.grupos.IdSalon);
            $("#IdGrado").val(data.grupos.IdGrado);
            $("#IdJornada").val(data.grupos.IdJornada);
            $select = $("#IdGrado");
            $select.trigger('change');
            listarAlum();

           /* $('#TAsign td').each(function() {
                //console.log(index)
                var valores = '';
                valores = $(this).parents("tr").find("td").eq(0).html();
                //console.log(data.Asignaturas.IdAsignatura,valores );

                data.Asignaturas.forEach(function(e) {
                    var parametro = $("input[name='checkAignatura']");
                    for (let index = 0; index < parametro.length; index++) {
                        if (e.IdAsignatura == valores) {
                            $('#checkAignatura_' + e.IdAsignatura).attr('checked', true);
                            break;
                        }
                    }
                });

            });            
            SelectAsig();*/
            SelectAlum();
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}

function DetalleArea(id) {
    $.get('detallarea/' + id, function(data) {
        if (data != null) {
            var valor = ''
            data.forEach(data => {
                valor += "<tr>" +
                    "<td>" + data.NombreMateria + "</td>" +
                    "<tr>";
            })
            $("#IdTableBodyDetalleArea").html(valor);
        } else {
            alert('Error al cargar los datos, verifica el proceso de detalle');
        }
    });
}

function DetalleMateria(id) {
    $.get('detallemat/' + id, function(data) {
        if (data != null) {
            var valor1 = ''
            data.forEach(data => {
                valor1 += "<tr>" +
                    "<td>" + data.NombreAsignatura + "</td>" +
                    "<tr>";
            })
            $("#IdTBodyDetalleMateria").html(valor1);
        } else {
            alert('Error al cargar los datos, verifica el proceso de detalle');
        }
    });
}

function DetalleAsignatura(id) {
    $.get('detalleasig/' + id, function(data) {
        if (data != null) {
            var valor2 = ''
            data.forEach(data => {
                valor2 += "<tr>" +
                    "<td>" + data.DescripcionLogro + "</td>" +
                    "<tr>";
            })
            $("#IdTBodyDetalleAsignatura").html(valor2);
        } else {
            alert('Error al cargar los datos, verifica el proceso de detalle');
        }
    });
}

function listarAlum() {
    var Id = $("#IdGrado").val();
    $.get('listalum/listalum/' + Id, function(data) {
        if (data != null) {
            var valor3 = ''
            data.forEach(data => {
                valor3 += "<tr>" +
                    "<td class='hidden'>" + data.IdAlumno + "</td>" +
                    "<td class='hidden'>" + "<input type='checkbox' name=" + data.IdAlumno + " id='acheckbox' class='form-check-input check'></input>" + "</td>" +
                    "<td>" + data.NumeroDocumento + "</td>" +
                    "<td>" + data.PrimerNombre + " " + data.SegundoNombre + " " + data.PrimerApellido + " " + data.SegundoApellido + "</td>" +
                    "<tr>";
            })
            $("#IdTBodyListAlumn").html(valor3);
        } else {
            alert('Error al cargar los datos, verifica el proceso de listar los alumnos de acuerdo al grado');
        }
    });
}

function SelectAlum() {
    $("#IdTBodyListAlumn input:checkbox").each(function() {
        $(this).prop('checked', true);
        var selected = new Array();
        selected.push($(this).parent().parent().find('td').eq(0).html());
        $("#data").append(
            '<input type="hidden" name="IdAlumno[]" value="' + selected + '">'
        )
    });
}


function SelectAsig() {
    $("#TAsign input:checkbox:checked").each(function() {
        var selectedAsig = new Array();
        selectedAsig.push($(this).parent().parent().find('td').eq(0).html());
        $("#data1").append(
            '<input type="hidden" name="IdAsignatura[]" value="' + selectedAsig + '">'
        )
    });
}

function SelectAsig1() {
    $("#data1").empty();
    console.log($('#data1').val());
    SelectAsig();
}

function listAlumMatr(id) {
    $.get('lismat/lismat/' + id, function(data) {
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

function AsignaNumerAuto() {
    $.get('autoincre/', function(data) {
        if (data != null) {
            $("#NumMatrAca").val(data.numMatricula);
            $("#CodigAca").val(data.codigo);
        } else {
            alert('Error al cargar los datos del numero de la matricula, lista y codigo interno');
        }
    });
}


$("#IdGradoIfAca").change(function() {
    var Id = $("#IdGradoIfAca").val();
    $.get('listalum/' + Id, function(data) {
        console.log(data);
        if (data != null) {
            $("#NumLisAca").val(data);
        } else {
            alert('Error al cargar los datos del numero del numero de lista del alumno');
        }
    });
});  



$("#IdGradoEv").change(function() {
    var IdGrado = $("#IdGradoEv").val();
    $.get('listasig/listasig/' + IdGrado, function(data) {
        if (data != null) {
            var valor4 = ''
            data.forEach(data => {
                valor4 += "<tr>" +
                    "<td class='hidden'>" + data.IdAsignatura + "</td>" +
                    "<td class='hidden'>" + "<input type='checkbox' name=" + data.IdAlumno + " id='acheckbox' class='form-check-input check'></input>" + "</td>" +
                    "<td>" + data.NombreAsignatura + "</td>" +
                    "<td>" + "<button type='button' onclick='ListAlum(" + data.IdGrupo + "," + data.IdAsignatura + ")' class='btn btn-primary' data-toggle='modal' data-target='.bd-example-modal-lg'><i class='fas fa-chalkboard-teacher'></i></button>" + "</td>" +
                    "<tr>";
            })
            $("#TblAsignaturaEvaluBody").html(valor4);
        } else {
            alert('Error al cargar las asignaturas que estan asociada a este grupo con este grado');
        }
    });
});




function evalAumno(IdAsignatura, IdAlumno, IdPeriodo) {
    if ($("#notaFinal").val() == "") {
        swal({
            type: 'warning',
            title: 'Upsss',
            animation: true,
            customClass: 'animated tada',
            text: 'No le has asignado una nota a este alumno. Si lo vas a evaluar por favor asignele una calificación'
        });
    } else {
        var NotaFinal = $("#notaFinal").val();
        var request = {
            IdAsignatura,
            IdAlumno,
            IdPeriodo,
            NotaFinal
        }

        var valParam = JSON.stringify(request);
        $.get('evalalum/evalalum/' + valParam, function(data) {
            if (data != null) {
                if (data.status == "success") {
                    swal({
                        type: 'success',
                        title: 'Exito',
                        animation: true,
                        customClass: 'animated tada',
                        text: data.message
                    });
                    $("#notaFinal").val(null);
                } else {
                    swal({
                        type: 'error',
                        title: 'Upsss',
                        animation: true,
                        customClass: 'animated tada',
                        text: data.message
                    });
                    $("#notaFinal").val(null);
                }
            } else {
                swal({
                    type: 'warning',
                    title: 'Upsss',
                    animation: true,
                    customClass: 'animated tada',
                    text: 'La evaluación del alumno no se pudo realizar, por favor recarga la pagina y vuelve a intentar!'
                });
                $("#notaFinal").val(null);
            }
        });
    }
}


function SelectAsig3() {
    $("#TAsign1 input:checkbox:checked").each(function() {
        var selectedAsig = new Array();
        selectedAsig.push($(this).parent().parent().find('td').eq(0).html());
        $("#datasig1").append(
            '<input type="hidden" name="IdAsignatura[]" value="' + selectedAsig + '">'
        )
    });
}


function SelectAsig2() {
    $("#datasig1").empty();
    console.log($('#datasig1').val());
    SelectAsig3();
}



function MostrarTipoGrupo(id) {
    $.get('updtipgrup/updtipgrup/' + id, function(data) {
        if (data != null) {

            $("#IdTipoGrupo").val(data.tipogrupo.IdTipoGrupo);
            $("#NombreTipoGrupo").val(data.tipogrupo.NombreTipoGrupo);
            $("#EstadoTipoGrupo").val(data.tipogrupo.EstadoTipoGrupo);


            $('#TAsign td').each(function() {
                //console.log(index)
                var valores = '';
                valores = $(this).parents("tr").find("td").eq(0).html();
                //console.log(data.Asignaturas.IdAsignatura,valores );

                data.asignaturas.forEach(function(e) {
                    var parametro = $("input[name='checkAignatura']");
                    for (let index = 0; index < parametro.length; index++) {
                        if (e.IdAsignaturaDetalleTipoGrupoAsignatura == valores) {
                            $('#checkAignatura_' + e.IdAsignaturaDetalleTipoGrupoAsignatura).attr('checked', true);
                            break;
                        }
                    }
                });

            });

            SelectAsig();
        } else {
            alert('Error al cargar los datos, verifica el proceso de editar');
        }
    });
}
