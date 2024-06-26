<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_SECURITY);
Security::verifyUserIsProfessor();

include(DIR_HEADER);
require_once(DIR_REPOSITORIES . "/consultasRepository.php");
$consultaRepository = new ConsultaRepository();

$consultas = $consultaRepository->getConsultasByProfesor($_SESSION["id"]);

?>

<script src="../tablas/crearTablaConsultasProfesor.js"></script>
<script>
    crearTabla()
</script>

<div class="container">
    <div class="row">
        <h1>Horarios de Consulta</h1>
    </div>
    <br><br><br>

    <div class="row">
        <div class="col-md-12">
            <table id="tablaConsultasProfesor" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Dia/Hora</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Año</th>
                        <th scope="col">Ingresar</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($consultas->num_rows == 0) {
                        echo "<tr><td colspan='5'>No hay consultas disponibles</td></tr>";
                    } else {
                        while ($row = $consultas->fetch_array()) { ?>
                            <tr>
                                <td><?= strtoupper($row['dia']) . " - " . $row['horarioFijo'] ?></td>
                                <td><?= $row['descripcionMateria'] ?></td>
                                <td><?= $row['nombreCarrera'] ?></td>
                                <td><?= $row['añoCursado'] ?></td>
                                <td>
                                    <a aria-label="Boton ingresar a consulta" href="ConsultasModBloq.php?p=<?= $row['idProfesor'] ?>&m=<?= $row['idMateria'] ?>&c=<?= $row['idCarrera'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a></td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>



<?php include(DIR_FOOTER); ?>