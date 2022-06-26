<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/consultasRepository.php");
require_once(DIR_SECURITY);
Security::verifyUserIsProfessor();

$consultaRepository = new ConsultaRepository();
$result = $consultaRepository->getConsultaById($_GET['id'])->fetch_array();

// Si un profesor quiere editar una consulta que no es suya, no se le permite entrar
if(!($_SESSION['id'] == $result['idProfesor'])){
    header("Location: " . REDIR_VIEWS . "/profesor/ConsultasProfesor.php");
    exit;
}

include(DIR_HEADER);
?>

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Modificar Consulta</h1>
        </div>
    </div>
    <form action="<?= REDIR_CONTROLLERS . "/profesor/editConsulta.php" ?>" method="POST">
        <div class="row justify-content-center">
            <div class="col-md-6 border p-3  bg-light ">
                <div class="form-group mb-3">Horario Alternativo
                    <input type="time" name="horarioAlternativo" class="form-control" placeholder="Hora Alternativo" autofocus value="<?= $result['horarioAlternativo'] ?>">
                </div>
                <div class="form-group mb-3">Modalidad
                    <select name="modalidad" class="form-control" id="modalidadSelect" onchange="placeholder()">
                        <option <?php if ($result['modalidad'] == "Presencial") {
                                    echo "Selected";
                                } ?> value="Presencial">Presencial</option>
                        <option <?php if ($result['modalidad'] == "Virtual") {
                                    echo "Selected";
                                } ?> value="Virtual">Virtual</option>
                    </select>
                </div>
                <div class="form-group mb-3">Ubicacion
                    <input type="text" id="ubicacionInput" name="ubicacion" class="form-control" value="<?=$result['ubicacion']?>">
                </div>
                <input class="btn btn-success btn-block" type="submit" id="editConsulta" name="edit_consulta" value="Guardar Cambios">
                <input name="idConsulta" hidden value="<?= $_GET['id'] ?>">

            </div>
        </div>
    </form>
</div>


<script>
    function placeholder(){
        var modalidad = document.getElementById("modalidadSelect").value;
        document.getElementById("ubicacionInput").value = "";
        document.getElementById("ubicacionInput").placeholder = 
            modalidad == "Presencial" ? "Aula" : "URL de Reunion";
    }
    /*
    function disable(select_val, input_id) {
        var e = document.getElementById(select_val);
        var strUser = e.options[e.selectedIndex].value;
        if (strUser === "Virtual") {
            document.getElementById(input_id).value = document.getElementById(input_id).defaultValue;
            document.getElementById(input_id).disabled = false;
            document.getElementById(input_id).required = true;
            
        } else {
            document.getElementById(input_id).value = "";
            document.getElementById(input_id).disabled = true;
            document.getElementById(input_id).required = false;
        }
    }
    window.onload = function() {
        disable('modalidadSelect', 'urlInput');
    };
    */
</script>
<?php include(DIR_FOOTER); ?>