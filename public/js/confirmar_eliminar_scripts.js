function cargarNotas(value) {
    // $('#notas').empty();
    if (value != "") {
        var table = $('#notas').DataTable({
            "ajax": "observador/notas/" + value,
            "columns": [
                { "data": "NombreMateria" },
                { "data": "NombreNota" },
                // { "data": "CantidadInasistencia" }
            ]
        });
        table.destroy();
    } else {
        swal('mensaje', 'seleccione un valor, valido', 'warning')
    }
}

function cargarInasistencias(value) {
    if (value != "") {
        var table = $('#inasistencias').DataTable({
            "ajax": "observador/inasistencias/" + value,
            "columns": [
                { "data": "NombreMateria" },
                { "data": "CantidadInasistencia" }
            ]
        });
        table.destroy();
    } else {
        swal('mensaje', 'seleccione un valor, valido', 'warning')
    }
}



$(document).ready(function() {
    $('.btn-delete').click(function(e) {
        e.preventDefault();
        if (!confirm("¿Esta seguro que desea eliminar este registro?")) {
            return false;
        }

        let row = $(this).parents('tr');
        let form = $(this).parents('form');
        let url = form.attr('action');

        $.post(url, form.serialize(), function(result) {
            row.fadeOut();
            swal('mensaje', '' + result.message + '', 'success');
        });


    });
})