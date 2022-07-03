<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
    require_once(DIR_REPOSITORIES . "/inscripcionRepository.php");
    require_once(DIR_REPOSITORIES . "/consultasRepository.php");

    if(isset($_POST['baja_btn'])){
        $InscripcionRepository = new InscripcionRepository();
        $idAlumno = $_SESSION['id'];
        $idConsulta = $_POST['idConsulta'];
        $result = $InscripcionRepository -> darDeBajaAlumnoEnConsulta($idAlumno,$idConsulta);
        if($result == 1){
            $_SESSION['message'] = "Inscripcion dada de baja exitosamente";
            $_SESSION['message_type'] = "success";
            header("Location: " . REDIR_VIEWS .  "/alumno/misInscripciones.php");
        exit;
        }
        $_SESSION['message'] = "La inscripcion no se pudo eliminar";
        $_SESSION['message_type'] = "warning";
        header("Location: " . REDIR_VIEWS .  "/alumno/misInscripciones.php");
        exit;
        
    }

?>