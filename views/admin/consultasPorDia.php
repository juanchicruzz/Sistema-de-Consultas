<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_SECURITY);

// Solo pueden ingresar los admin a esta vista, si es alumno se redirige a login o index
Security::verifyUserIsAdmin();
// 
include(DIR_HEADER)
?>

<script type="text/javascript" charset="utf8" src="../tablas/crearTablaConsultas.js"></script>
<script> crearTabla() </script>

<?php
    include(DIR_REPOSITORIES . "/consultasRepository.php");
    $ConsultaRepo = new ConsultaRepository();
    if (isset($_GET['fecha']) && (!$_GET['fecha'] == '')) {
        $result = $ConsultaRepo->getConsultasPorDia($_GET['fecha']);
    }
    else
    {
        $result = $ConsultaRepo->getAllConsultas();
    }
?>
    <div class="container p-4">
        <div class="row bg-light border">
            <h1>Listado de Consultas</h1>   
        </div>
        <br><br><br>

        
        <div class="row">
            <form method="GET" action = <?=htmlspecialchars($_SERVER['PHP_SELF'])?>>
                <div class="row">
                    <div class="col-md-3">
                        <strong>Ingresar Fecha</strong>  <input type="date" id="fechaBusca" name="fecha">
                    </div>
                    <div class="col-md-3">
                        <input class="btn btn-primary" type="submit" value="Buscar">
                    </div>
                <div>
        </form>
        <br><br>
        <?php
            if (!(isset($_GET['fecha']))) {
                echo "<h2>Listado de consultas</h2>";
            }
            else
            {
               echo "<h2>Listado de consultas para la fecha: " .$_GET['fecha']."</h2>";
            }
        ?>
        <div class="row">
            <div class="col-md-3">
                <a class="btn btn-primary" href="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>?fecha="> Mostrar Todas </a>
            </div>
        </div>
        <br>
       <table id= "tablaConsultas" class="display table table-striped table-hover">
           <thead class="thead-dark">
               <th scope="col">Profesor</th>
               <th scope="col">Fecha</th>
               <th scope="col">Materia</th>
               <th scope="col">Carrera</th>
               <th scope="col">Modalidad</th>
               <th scope="col">Motivo Cancelacion</th>
           </thead>
           <tbody>
            <?php
                while($row = $result->fetch_array()){
            ?>
                <tr>
                    <td><?=$row['profesor']?></td>
                    <td><?=$row['fecha']?></td>
                    <td><?=$row['descripcionMateria']?></td>
                    <td><?=$row['nombreCarrera']?></td>
                    <td><?=$row['modalidad']?></td>
                    <td><?=$row['motivoCancelacion']?></td>
                </tr>
            <?php
                }
            ?>
           </tbody>
       </table>
    </div>

<?php include(DIR_FOOTER);?>