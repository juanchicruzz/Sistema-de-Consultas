<?php

ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/consultasRepository.php");
require_once(DIR_REPOSITORIES . "/inscripcionRepository.php");
require_once(DIR_SECURITY);
Security::verifyUserIsProfessor();

$consultaRepository = new ConsultaRepository();
$inscripcionRepository = new InscripcionRepository();
$result = $consultaRepository->getConsultaById($_GET['id'])->fetch_array();
$numInscripciones = $inscripcionRepository->getInscripcionesByConsulta($_GET['id'])->num_rows;

// Si un profesor quiere editar una consulta que no es suya, no se le permite entrar
if (!($_SESSION['id'] == $result['idProfesor'])) {
    header("Location: " . REDIR_VIEWS . "/profesor/ConsultasProfesor.php");
    exit;
} else {
    if ($result['estado'] == "Bloqueada") {
        header("Location: " . REDIR_VIEWS . "/profesor/ConsultasProfesor.php");
        exit;
    }
}

include(DIR_HEADER);
?>

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Bloquear Consulta</h1>
        </div>
    </div>
    <br>
    <form action="<?= REDIR_CONTROLLERS . "/profesor/bloqConsulta.php" ?>" method="POST">
        <div class="row justify-content-center">
            <div class="col-md-6 border p-3  bg-light ">
                <div class="form-group mb-3">
                    <label for="motivo"> Ingrese el motivo del bloqueo</label>
                    <br><br>
                    <input required id="motivo" type="text" name="motivo" class="form-control" placeholder="Motivo de bloqueo" autofocus>
                </div>

                <?php
                if($numInscripciones > 0){ ?>
                <p>Actualmente esta consulta tiene <?=$numInscripciones?> inscripciones activas.</p>
                <p>¿Desea continuar de todas formas? Se enviará un mail a los alumnos inscriptos.</p>
                <?php 
                    }
                ?>
                <input class="btn btn-danger btn-block" type="submit" id="bloqConsulta" name="bloq_consulta" value="Bloquear Consulta">
                <input class="btn btn-secondary btn-block" onclick="history.back()" type="button" name="cancelar" value="Cancelar">
                <input name="idConsulta" hidden value="<?= $_GET['id'] ?>">
                <input name="materia" hidden value="<?= $result['idMateria'] ?>">
                <input name="fecha" hidden value="<?= $result['fecha'] ?>">
                <input name="profesor" hidden value="<?= $result['idProfesor'] ?>">


            </div>
        </div>
    </form>
</div>

<?php include(DIR_FOOTER); ?>