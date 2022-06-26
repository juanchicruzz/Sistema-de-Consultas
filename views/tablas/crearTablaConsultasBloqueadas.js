function crearTabla(){
    $(document).ready(function() {
    $('#tablaConsultasBloqueadas').DataTable({
        language: {
            lengthMenu: 'Mostrar _MENU_ registros por pagina',
            zeroRecords: 'No hay resultados',
            info: 'Mostrando pagina _PAGE_ de _PAGES_',
            infoEmpty: 'No hay consultas con ese filtro',
            loadingRecords: "Cargando...",
            search: "Filtrar por dia, profesor o materia:",
            paginate: {
            "first":      "Primero",
            "last":       "Ultimo",
            "next":       "Siguiente",
            "previous":   "Anterior"
            },
            infoFiltered:   "",
        },
        columnDefs: [
            { orderable: false, targets: [] }
          ],
          order: [[1, 'asc']]
    })
});
}