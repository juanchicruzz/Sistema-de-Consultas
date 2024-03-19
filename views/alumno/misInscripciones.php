<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/inscripcionRepository.php");
require_once(DIR_SECURITY);
Security::verifyUser("1");

require_once(DIR_HEADER);


$InscripcionRepository = new InscripcionRepository();
$inscripciones = $InscripcionRepository->getInscripcionesByAlumno($_SESSION['id']);

function consultaExpiro($fechaSQL, $horaSQL)
{
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fechaActual = date("Y-m-d");
    if ($fechaActual > $fechaSQL) {
        return true;
    }
    if ($fechaActual == $fechaSQL) {
        $horaActual = date("H:i");
        if ($horaActual > $horaSQL) {
            return true;
        }
    }
    return false;
}

function menorA24Horas($fechaSQL, $horaSQL)
{
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $date1 = new DateTime($fechaSQL . " " . $horaSQL);
    $date2 = new DateTime("now");
    $diff = $date1->diff($date2);
    if ($diff->y == 0 && $diff->m == 0 && $diff->d == 0) {
        // si todo es igual a cero entonces la diferencia solo es de horas
        // si es menor a 24 no dejamos que se de de baja
        return ($diff->h < 24);
    }
}
?>



<body>

    <script src="../tablas/crearTablaMisInscripciones.js"> </script>
    <script>crearTabla()</script>

    <div class="container">
        <div class="row">
            <h1>Mis Inscripciones </h1>
        </div>
        <?php
        if (isset($_SESSION['message'])) {
        ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?>
                alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        <?php
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        }
        ?>

        <br><br>
        <div class="row">
            <div class="col-md-12">
                <table id="tablaConsultas" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Materia</th>
                            <th scope="col">Fecha y hora</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Modalidad</th>
                            <th scope="col">Ubicacion</th>
                            <th scope="col">Motivo Consulta</th>
                            <th scope="col">DAR DE BAJA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($inscripciones->num_rows == 0) {
                            echo "<tr><td colspan='5'>Aún no te inscribiste a ninguna consulta</td></tr>";
                        } else {
                            while ($row = $inscripciones->fetch_array()) { ?>
                                <tr>
                                    <td><?= $row['descripcionMateria'] . " (" . $row['nombreCarrera'] . ")" ?></td>
                                    <td><?= Utils::convertirFechaFromSQL($row['fecha']) . " - " . $row['horario'] ?></td>
                                    <td><?= $row['estado'] ?></td>
                                    <td><?= $row['modalidad'] ?></td>
                                    <td><?= $row['ubicacion'] ?></td>
                                    <td style="word-wrap: break-word; max-width: 20px"><?= $row['motivoConsulta'] ?></td>
                                    <?php
                                    if (consultaExpiro($row['fecha'], $row['horario'])) {
                                        echo "<td style='color:grey;'>Consulta expiró</td>";
                                        continue;
                                    }
                                    if (menorA24Horas($row['fecha'], $row['horario'])) {
                                        echo "<td style='color:grey;'>No es posible dar de baja.<br>Tiempo restante menor a 24 hs.</td>";
                                        continue;
                                    }
                                    ?>
                                    <td>
                                        <button type="button" aria-label="Boton dar de baja inscripcion" class="btn" data-bs-toggle="modal" data-bs-target="#darDeBajaModal" data-bs-fecha="<?= $row['dia'] . " " . Utils::convertirFechaFromSQL($row['fecha']) . " - " . $row['horario'] ?>" data-bs-materia="<?= $row['descripcionMateria'] . " (" . $row['nombreCarrera'] . ")" ?>" data-bs-idconsulta="<?= $row['idConsulta'] ?>">
                                            <i class="fas fa-circle-minus" style="color:red;"></i>
                                        </button>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>


                <div class="modal fade" id="darDeBajaModal" tabindex="-1" aria-labelledby="darDeBajaModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Darse de baja a consulta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="<?= REDIR_CONTROLLERS ?>/inscripciones/bajaInscripcion.php">
                                    <div class="mb-3">
                                        <input hidden aria-label="id consulta oculto" id="idConsultaModal" name="idConsulta">
                                        <p id="materiaModal" style="font-weight:bold;"></p>
                                        <p id="fechaModal" style="font-weight:bold;"></p>
                                        <p class="col-form-label">¿Estas seguro que deseas darte de baja?</p>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger" name="baja_btn">Darse de baja</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <SCRIPT>
        var darDeBajaModal = document.getElementById('darDeBajaModal');
        darDeBajaModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var fecha = button.getAttribute('data-bs-fecha');
            var materia = button.getAttribute('data-bs-materia');
            var idConsulta = button.getAttribute('data-bs-idconsulta');
            darDeBajaModal.querySelector('#materiaModal').textContent = fecha;
            darDeBajaModal.querySelector('#fechaModal').textContent = materia;
            document.getElementById('idConsultaModal').value = idConsulta;
        });
    </SCRIPT>

    <?php include(DIR_FOOTER); ?>

</body>