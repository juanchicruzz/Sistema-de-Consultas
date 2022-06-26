
function crearTabla(){
    $(document).ready(function() {
    $('#tablaConsultasProfesor').DataTable({
        language: {
            lengthMenu: 'Mostrar _MENU_ registros por pagina',
            zeroRecords: 'No hay resultados',
            info: 'Mostrando pagina _PAGE_ de _PAGES_',
            infoEmpty: 'No hay consultas con ese filtro',
            loadingRecords: "Cargando...",
            search: "Filtrar por materia, carrera y año:",
            paginate: {
            "first":      "Primero",
            "last":       "Ultimo",
            "next":       "Siguiente",
            "previous":   "Anterior"
            },
            infoFiltered:   "",
        },
        columnDefs: [
            { orderable: false, targets: [4] },
            { searchable: false, targets: [4] }

          ],
          order: [[1, 'asc']]
    })
});
}