function crearTabla(){
    $(document).ready(function() {
    $('#tablaConsultasBloqueadas').DataTable({
        language: {
            lengthMenu: 'Mostrar _MENU_ registros por pagina',
            zeroRecords: 'No hay resultados',
            info: 'Mostrando pagina _PAGE_ de _PAGES_',
            infoEmpty: 'No hay consultas con ese filtro',
            loadingRecords: "Cargando...",
            search: "Filtrar por fecha, materia o carrera:",
            paginate: {
            "first":      "Primero",
            "last":       "Ultimo",
            "next":       "Siguiente",
            "previous":   "Anterior"
            },
            infoFiltered:   "",
        },
        columnDefs: [
            { orderable: false, targets: [0,1,2,3,4,5,6] },
            { searchable: false, targets: [4,5,6] }
          ],
          order: [[6, 'asc']]
    })
});
}