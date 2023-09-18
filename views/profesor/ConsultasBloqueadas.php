<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_SECURITY);
Security::verifyUserIsProfessor();

include(DIR_HEADER);
require_once(DIR_REPOSITORIES . "/consultasRepository.php");
$consultaRepository = new ConsultaRepository();

$profesor = $_SESSION['id'];


$consultas = $consultaRepository->getConsultasBloqueadasByProfesor($profesor);


?>

<script src="../tablas/crearTablaInscripcion.js"></script>
<script>
    crearTabla()
</script>

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 style="text-align: center;">Desbloquear Consultas</h1>
        </div>
        <br>
        <form style="padding-bottom: 30px;" action="<?= REDIR_CONTROLLERS . "/profesor/desbloqSemana.php" ?>" method="POST">
            <div class="row justify-content-center">
                <div class="col-md-6 border p-3  bg-light ">
                    <div class="form-group mb-3">
                        <label for="StartDate"> Fecha Desde </label>
                        <input id="StartDate" name="StartDate" class="form-control" type="date" onchange="validaFecha('EndDate','StartDate')" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="EndDate"> Fecha Hasta</label>
                        <input id="EndDate" name="EndDate" class="form-control" type="date" onchange="validaFecha('EndDate','StartDate')" />
                    </div>
                    <button class="btn btn-success btn-block" name="desbloqSemana_consulta" type="submit" id="desbloqSemanaConsulta">Desbloquear Consultas</button>
                    <input name="idProfesor" hidden value="<?= $_SESSION['id'] ?>">
                </div>
            </div>
        </form>
        <hr>
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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 style="text-align: center;">Consultas Bloqueadas</h1>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table id="tablaInscripcion" class="display table table-striped table-hover" id="table_id">
                    <thead>
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Modalidad</th>
                            <th scope="col">Ubicacion</th>
                            <th scope="col">Horario Alternativo</th>
                            <th scope="col">Desbloquear</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($consultas->num_rows == 0) {
                            echo "<tr><td width:100%>No hay consultas disponibles</td></tr>";
                        } else {
                            while ($row = $consultas->fetch_array()) { ?>
                                <tr>
                                    <td><?= Utils::convertirFechaFromSQL($row['fecha']) ?></td>
                                    <td><?= $row['estado'] ?></td>
                                    <td><?= $row['modalidad'] ?></td>
                                    <td><?= $row['ubicacion'] ?></td>
                                    <td><?= $row['horarioAlternativo'] ?></td>
                                    <td>
                                        <a href="<?= REDIR_CONTROLLERS ?>/profesor/desbloqConsulta.php?id=<?= $row["idConsulta"] ?>">
                                            <i class=" fa-solid fa-unlock" style="color:green;"></i>
                                        </a>
                                    </td>

                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function validaFecha(startId, endId) {
        var startDate = document.getElementById(startId).value;
        var endDate = document.getElementById(endId).value;
        if ((Date.parse(startDate) <= Date.parse(endDate))) {
            alert("La fecha hasta no puede ser menor a la fecha desde.");
            document.getElementById("EndDate").value = "";
        }
    };
</script>

<?php include(DIR_FOOTER); ?>