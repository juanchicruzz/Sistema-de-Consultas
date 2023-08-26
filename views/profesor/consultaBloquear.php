<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/consultasRepository.php");
require_once(DIR_SECURITY);
Security::verifyUserIsProfessor();

$consultaRepository = new ConsultaRepository();
$result = $consultaRepository->getConsultaById($_GET['id'])->fetch_array();

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
            <h1>Modificar Consulta</h1>
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
                <button class="btn btn-danger btn-block" name="bloq_consulta" type="submit" id="bloqConsulta">Bloquear Consulta</button>
                <input name="idConsulta" hidden value="<?= $_GET['id'] ?>">
            </div>
        </div>
    </form>
</div>

<?php include(DIR_FOOTER); ?>