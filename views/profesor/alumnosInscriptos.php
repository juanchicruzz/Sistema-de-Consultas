<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_SECURITY);
Security::verifyUserIsProfessor();

include(DIR_HEADER);
require_once(DIR_REPOSITORIES . "/inscripcionRepository.php");
require_once(DIR_REPOSITORIES . "/consultasRepository.php");
$inscripcioRepository = new InscripcionRepository();
$consultaRepository = new ConsultaRepository();

$idConsulta = $_GET['c'];



$alumnosInscripciones = $inscripcioRepository->getInscripcionesByConsulta($idConsulta);



$detalles = $consultaRepository->getInfoConsultaById($idConsulta)->fetch_array();

// Si un profesor quiere editar una consulta que no es suya, no se le permite entrar


?>

<script type="text/javascript" charset="utf8" src="tablas/crearTablaInscripcion.js"></script>
<script>
    crearTabla()
</script>

<div class="container">
    <div class="row">
        <h1>Alumnos Inscriptos</h1>
        <div class="col-md-6 bg-light border">
            <br>
            <h3><?= $detalles['dia'] . " - " . Utils::convertirFechaFromSQL($detalles['fecha']) ?> </h3>
            <h4><i>Ubicacion: <?= $detalles['ubicacion'] ?></i></h4>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-12">
            <table id="tablaInscripcion" class="display table table-striped table-hover" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">Alumno</th>
                        <th scope="col">Legajo</th>
                        <th scope="col">Motivo</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($alumnosInscripciones->num_rows == 0) {
                        echo "<tr><td width:100%>No hay consultas disponibles</td></tr>";
                    } else {
                        while ($row = $alumnosInscripciones->fetch_array()) { ?>
                            <tr>
                                <td><?= $row['alumno'] ?></td>
                                <td><?= $row['legajo'] ?></td>
                                <td><?= $row['motivoConsulta'] ?></td>
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
