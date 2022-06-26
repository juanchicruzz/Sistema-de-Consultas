<?php
include("../partials/header.php");
require_once("../db/repositories/consultasRepository.php");
$consultaRepository = new ConsultaRepository();

$profesor = $_GET['p'];
$materia = $_GET['m'];
$carrera = $_GET['c'];

$consultas = $consultaRepository->getConsultasByPrimaryKey($profesor, $materia, $carrera);
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
            <h3><?=$detalles['materia'] . " - " . $detalles['carrera']?> </h3>
            <h4><i>Profesor/a: <?=$detalles['profesor']?></i></h4>
        </div>
    </div>
    <br><br>

    <div class="row">
        <div class="col-md-12">
            <table id="tablaInscripcion" class="display table table-striped table-hover" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Modalidad</th>
                        <th scope="col">URL</th>
                        <th scope="col">Horario Alternativo</th>
                        <th scope="col">Inscribirse</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($consultas->num_rows == 0) {
                        echo "<tr><td width:100%>No hay consultas disponibles</td></tr>";
                    } else {
                        while ($row = $consultas->fetch_array()) { ?>
                            <tr>
                                <td><?= Utils::convertirFechaFromSQL($row['fecha'])?></td>
                                <td><?= $row['estado'] ?></td>
                                <td><?= $row['modalidad'] ?></td>
                                <td><?= $row['url'] ?></td>
                                <td><?= $row['horarioAlternativo'] ?></td>
                                <?php if($row['estado'] == "Bloqueada"){
                                    echo '<td align="center"><a role="link" aria-disabled="true"><i class="fas fa-user-check" style="color:grey;"></i></a></td>';
                                }else{
                                    echo '<td align="center" ><a href="inscripcion.php?p='. 
                                        $profesor . '&m='.$materia.'&c='.$carrera.'">
                                        <i class="fas fa-user-check"></i> </a></td>';
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

<br><br><br><br><br><br><br><br><br>


<?php include("../partials/footer.php"); ?>