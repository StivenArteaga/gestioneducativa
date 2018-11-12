function cargarNotas(value) {
    $('#notas').DataTable({
        "ajax": "observador/notas",
        // "columns": [
        //     { "data": "name" },
        //     { "data": "position" },
        //     { "data": "office" },
        //     { "data": "extn" },
        //     { "data": "start_date" },
        //     { "data": "salary" }
        // ]
    });
}