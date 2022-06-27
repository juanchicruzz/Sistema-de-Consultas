<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/consultasRepository.php");

    if(isset($_POST['bloq_consulta'])){
        $ConsultaRepository = new ConsultaRepository();
        $motivo = strval($_POST['motivo']);
        $idConsulta = $_POST['idConsulta'];
        $consulta = $ConsultaRepository->getConsultaById($idConsulta)->fetch_array();
      
        $result_query = $ConsultaRepository->bloquearConsulta($motivo,$idConsulta); 
        if(!$result_query){
            die("Update query failed");
        }
        $_SESSION['message'] = "Consulta bloqueda exitosamente";
        $_SESSION['message_type'] = "danger";
        header("Location: " . REDIR_VIEWS . "/profesor/consultasModBloq.php?p=".$consulta['idProfesor']."&m=".$consulta['idMateria']."&c=".$consulta['idCarrera']);
        exit;
    }
