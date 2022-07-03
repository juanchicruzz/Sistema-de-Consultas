<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
    require_once(DIR_REPOSITORIES . "/inscripcionRepository.php");
    require_once(DIR_REPOSITORIES . "/consultasRepository.php");

    if(isset($_POST['inscribir_btn'])){
        $InscripcionRepository = new InscripcionRepository();
        $ConsultaRepository = new ConsultaRepository();
        $idAlumno = $_SESSION['id'];
        $idConsulta = $_POST['idConsulta'];
        $motivo = $_POST['motivo'];
        $result = $InscripcionRepository -> getInscripcionByConsultaAndAlumno($idConsulta, $idAlumno);
        if($result->num_rows > 0 ){
            die("Esa inscripcion ya existe");
        }
        
        $result_query = $InscripcionRepository->inscribirAlumnoEnConsulta($idAlumno, $idConsulta, $motivo); 
        if(!$result_query){
            die("Insert query failed");
        }
        $_SESSION['message'] = "Usuario inscripto exitosamente";
        $_SESSION['message_type'] = "success";
        header("Location: " . REDIR_VIEWS .  "/alumno/misInscripciones.php");
        exit;
    }

?>