<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/consultasRepository.php");

$consultaRepository = new ConsultaRepository();

if (isset($_GET["carrera"])) {
    $consultas = $consultaRepository->getConsultasByCarrera($_GET["carrera"]);
}
if (isset($_GET["a"])) {
    $consultas = $consultaRepository->getConsultasByAño($_GET["a"]);
}
if (!isset($_GET["carrera"]) && !isset($_GET["a"])) {
    $consultas = $consultaRepository->getConsultasGeneral();
}
?>


<?php require_once(DIR_HEADER); ?>

<script src="tablas/crearTablaConsultas.js"></script>
<script>
    crearTabla()
</script>

<div class="container">
    <div class="row">
        <h1>Horarios de Consulta</h1>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Carrera
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">TODAS</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?carrera=1">ISI</a></li>
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?carrera=3">IE</a></li>
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?carrera=4">IM</a></li>
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?carrera=5">IQ</a></li>
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?carrera=2">IC</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                    Año
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">TODOS</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?a=1">1°</a></li>
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?a=2">2°</a></li>
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?a=3">3°</a></li>
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?a=4">4°</a></li>
                    <li><a class="dropdown-item" href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?a=5">5°</a></li>
                </ul>
            </div>
        </div>

    </div>

    <br>
    <div class="row">
        <div class="col-md-12">
            <table id="tablaConsultas" class="display table table-striped table-hover" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">Dia/Hora</th>
                        <th scope="col">Profesor</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Inscribirse</th>
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
                                <td><?= $row['profesor'] ?></td>
                                <td><?= $row['descripcionMateria'] ?></td>
                                <td><?= $row['nombreCarrera'] ?></td>
                                <?php if($_SESSION['userType'] == 1) { ?>
                                    <td>
                                        <a aria-label="Boton ingresar a fechas para la consulta" href="<?= REDIR_VIEWS ?>/alumno/inscripcion.php?p=<?= $row['idProfesor'] ?>&m=<?= $row['idMateria'] ?>&c=<?= $row['idCarrera'] ?>">
                                        <i class="fas fa-user-check"></i>
                                        </a>
                                    </td>
                                    <?php }  ?>
                                    <?php if($_SESSION['userType'] == 3) { ?>
                                    <td>
                                        <a aria-label="Boton ingresar a fechas para la consulta" aria-disabled="true">
                                        <i class="fas fa-user-check fa-lock"></i>
                                        </a>
                                    </td>
                                    <?php } ?>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<br>


<?php include(DIR_FOOTER); ?>