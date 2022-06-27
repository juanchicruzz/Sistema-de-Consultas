<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_SECURITY);
Security::verifyUserIsProfessor();

include(DIR_HEADER);
require_once(DIR_REPOSITORIES . "/consultasRepository.php");
$consultaRepository = new ConsultaRepository();

$profesor = $_GET['p'];
$materia = $_GET['m'];
$carrera = $_GET['c'];

// Si un profesor quiere editar una consulta que no es suya, no se le permite entrar
if(!($_SESSION['id'] == $profesor)){
    header("Location: " . REDIR_VIEWS . "/profesor/ConsultasProfesor.php");
    exit;
}

$consultas = $consultaRepository->getConsultasByPrimaryKey($profesor, $materia, $carrera);

// Si un profesor quiere acceder a una terna que no existe se redirige
if($consultas -> num_rows == 0){
    header("Location: " . REDIR_VIEWS . "/profesor/ConsultasProfesor.php");
    exit;
}
$detalles = $consultaRepository->getDetallesParaInscripcion($profesor, $materia, $carrera)->fetch_array();

?>

<script type="text/javascript" charset="utf8" src="tablas/crearTablaInscripcion.js"></script>
<script>
    crearTabla()
</script>

<div class="container">
    <div class="row">
        <h1>Inscripcion a Consulta</h1>
        <div class="col-md-6 bg-light border">
            <br>
            <h3><?= $detalles['materia'] . " - " . $detalles['carrera'] ?> </h3>
            <h4><i>Profesor/a: <?= $detalles['profesor'] ?></i></h4>
        </div>
    </div>
    <br><br>
    <?php
            if(isset($_SESSION['message'])){
        ?>
            <div class="alert alert-<?=$_SESSION['message_type']?>
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
            <table id="tablaInscripcion" class="display table table-striped table-hover" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Modalidad</th>
                        <th scope="col">Ubicacion</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Modificar</th>
                        <th scope="col">Bloquear/Desbloquear</th>
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
                                <td><?= $row['horario'] ?></td>
                                <td><a href="consultaEdit.php?id=<?= $row['idConsulta'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a></td>
                                <?php if($row['estado'] == "Bloqueada"){
                                    echo '<td><a href="'.REDIR_CONTROLLERS.'/profesor/desbloqConsulta.php?id='. $row["idConsulta"] .' "><i class="fa-solid fa-unlock" style="color:green;"></i></a></td>';
                                }else{
                                    echo '<td><a href="consultaBloquear.php?id='. $row["idConsulta"] .' "><i class="fa-solid fa-lock" style="color:red;"></i></a></td>';
                                } ?>
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
