function cargarNotas(value) {
    // $('#notas').empty();
    if (value != "") {
        var table = $('#notas').DataTable({
            "ajax": "observador/notas/" + value,
            "columns": [
                { "data": "NombreMateria" },
                { "data": "NombreNota" }
            ]
        });
        table.destroy();
    } else {
        swal('mensaje', 'seleccione un valor, valido', 'warning')
    }
}

// function confirmarEliminar(false) {
//     // event.preventDefault();
//     swal({
//             title: "Are you sure?",
//             text: "Once deleted, you will not be able to recover this imaginary file!",
//             icon: "warning",
//             buttons: true,
//             dangerMode: true,
//         })
//         .then((willDelete) => {
//             if (willDelete) {
//                 event.target.submit();
//                 document.formularioEliminar.submit();
//                 swal("Poof! Your imaginary file has been deleted!", {
//                     icon: "success",
//                 });
//             } else {
//                 swal("Your imaginary file is safe!");
//             }
//         });
//     return false;
// }

$(document).ready(function() {
    $('.btn-delete').click(function(e) {
        e.preventDefault();
        if (!confirm("¿Esta seguro que desea eliminar este alumno?")) {
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