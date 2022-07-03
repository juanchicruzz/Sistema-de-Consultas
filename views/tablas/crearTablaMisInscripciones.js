
function crearTabla(){
    $(document).ready(function() {
    $('#tablaConsultas').DataTable({
        language: {
            lengthMenu: 'Mostrar _MENU_ registros por pagina',
            zeroRecords: 'No hay resultados',
            info: 'Mostrando pagina _PAGE_ de _PAGES_',
            infoEmpty: 'No hay consultas con ese filtro',
            loadingRecords: "Cargando...",
            search: "Filtrar por materia o estado:",
            paginate: {
            "first":      "Primero",
            "last":       "Ultimo",
            "next":       "Siguiente",
            "previous":   "Anterior"
            },
            infoFiltered:   "",
        },
        columnDefs: [
            { orderable: false, targets: [1,3,4,5,6] }
          ]
    })
});
}