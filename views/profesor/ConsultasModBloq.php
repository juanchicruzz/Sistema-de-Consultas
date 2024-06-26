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

$consultas = $consultaRepository->getConsultasByPrimaryKeyConInscripciones($profesor, $materia, $carrera);

// Si un profesor quiere acceder a una terna que no existe se redirige
if($consultas -> num_rows == 0){
    header("Location: " . REDIR_VIEWS . "/profesor/ConsultasProfesor.php");
    exit;
}
$detalles = $consultaRepository->getDetallesParaInscripcion($profesor, $materia, $carrera)->fetch_array();

?>

<script src="tablas/crearTablaInscripcion.js"></script>
<script>
    crearTabla()
</script>

<div class="container">
    <div class="row">
        <h1>Modificar/Bloquear Consulta</h1>
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
            <table id="tablaInscripcion" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Modalidad</th>
                        <th scope="col">Ubicacion</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Inscriptos</th>
                        <th scope="col">Acciones</th>
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
                                <td><?= $row['inscriptos'] ?></td>
                                <td>
                                    <a title="Ver Inscriptos" style="text-decoration: none;" href=<?= "alumnosInscriptos.php?c=".$row["idConsulta"]?> >
                                        <i class="fas fa-user-group"></i>
                                    </a> <span>|</span>
                                    <a title="Editar Consulta" style="text-decoration: none;" href="consultaEdit.php?id=<?= $row['idConsulta'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </a><span>|</span>
                                    <?php if($row['estado'] == "Bloqueada"){
                                    echo '<a title="Desbloquear Consulta" style="text-decoration: none;"  href="'.REDIR_CONTROLLERS.'/profesor/desbloqConsulta.php?id='. $row["idConsulta"] .' "><i class="fa-solid fa-unlock" style="color:green;"></i></a>';
                                }else{
                                    echo '<a title="Bloquear Consulta" style="text-decoration: none;"  href="consultaBloquear.php?id='. $row["idConsulta"] . 
                                    '&materia=' . '&fecha=' . $row['fecha']
                                    .'"><i class="fa-solid fa-lock" style="color:red;"></i></a>';
                                } ?>
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



<?php include(DIR_FOOTER); ?>
