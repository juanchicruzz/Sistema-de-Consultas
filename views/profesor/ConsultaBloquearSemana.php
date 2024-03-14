<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_SECURITY);
Security::verifyUserIsProfessor();

include(DIR_HEADER);
require_once(DIR_REPOSITORIES . "/consultasRepository.php");
$consultaRepository = new ConsultaRepository();
$profesor = $_SESSION['id'];

$consultas = $consultaRepository->getConsultasActivasByProfesor($profesor);

?>



<script src="../tablas/crearTablaConsultasBloqueadas.js"></script>
<script>
    crearTabla()
</script>

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 style="text-align: center;">Bloquear Consultas</h1>
        </div>
    </div>
    <br>

    <form action="<?= REDIR_CONTROLLERS . "/profesor/bloqSemana.php" ?>" method="POST">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="border p-3 bg-light">
                        <div class="mb-3">
                            <label for="StartDate" class="form-label">Fecha Inicio</label>
                            <input id="StartDate" name="StartDate" class="form-control" type="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="EndDate" class="form-label">Fecha Fin</label>
                            <input id="EndDate" name="EndDate" class="form-control" type="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="motivo" class="form-label">Motivo de Bloqueo</label>
                            <input id="motivo" name="motivo" class="form-control" type="text" placeholder="Motivo de bloqueo" required autofocus>
                        </div>
                        <button class="btn btn-danger btn-block" type="submit">Bloquear Consultas</button>
                        <input name="idProfesor" type="hidden" value="<?= $_SESSION['id'] ?>">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <br>
    <hr>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 style="text-align: center;">Consultas Activas</h1>
        </div>
    </div>
    <br>
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
    <div class="row">
        <div class="col-md-12">
            <table id="tablaConsultasBloqueadas" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Modalidad</th>
                        <th scope="col">Bloquear</th>
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
                                <td><?= $row['horarioAlternativo'] ?></td>
                                <td><?= $row['descripcionMateria'] ?></td>
                                <td><?= $row['nombreCarrera'] ?></td>
                                <td><?= $row['estado'] ?></td>
                                <td><?= $row['modalidad'] ?></td>
                                <td>
                                    <a aria-label="Boton bloquear consulta" href="consultaBloquear.php?id=<?= $row["idConsulta"] ?>">
                                        <i class="fa-solid fa-lock" style="color:red;"></i>
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