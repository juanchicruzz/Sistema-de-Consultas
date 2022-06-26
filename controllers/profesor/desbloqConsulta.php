<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/consultasRepository.php");

    if(isset($_GET['id'])){
        $ConsultaRepository = new ConsultaRepository();
        $idConsulta = $_GET['id'];
        $consulta = $ConsultaRepository->getConsultaById($idConsulta)->fetch_array();

        if(!($_SESSION['id'] == $consulta['idProfesor'])){
            header("Location: " . REDIR_VIEWS . "/profesor/ConsultasProfesor.php");
            exit;
        }
      
        $result_query = $ConsultaRepository->DesbloquearConsulta($idConsulta); 
        if(!$result_query){
            die("Update query failed");
        }
        $_SESSION['message'] = "Consulta Desbloqueada exitosamente";
        $_SESSION['message_type'] = "success";
        header("Location: " . REDIR_VIEWS . "/profesor/ConsultasModBloq.php?p=".$consulta['idProfesor']."&m=".$consulta['idMateria']."&c=".$consulta['idCarrera']);
        exit;
    }
