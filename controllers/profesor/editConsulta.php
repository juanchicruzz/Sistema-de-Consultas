<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/consultasRepository.php");

    if(isset($_POST['edit_consulta'])){
        $ConsultaRepository = new ConsultaRepository();
        $horarioAlt = strval($_POST['horarioAlternativo']);
        $modalidad = $_POST['modalidad'];
        $idConsulta = $_POST['idConsulta'];
        $url = $_POST['ubicacion'] == "0" ? null : $_POST['ubicacion'];

        
        $consulta = $ConsultaRepository->getConsultaById($idConsulta)->fetch_array();
        if($consulta['modalidad'] == $modalidad 
            && $consulta['ubicacion'] == $url 
            && $consulta['horarioAlternativo'] == $horarioAlt){
                header("Location: " . REDIR_VIEWS . "/profesor/ConsultasModBloq.php?p=".$consulta['idProfesor']."&m=".$consulta['idMateria']."&c=".$consulta['idCarrera']);
                exit;
        }
        
      
        $result_query = $ConsultaRepository->updateConsulta($modalidad, $horarioAlt, $url, $idConsulta); 
        if(!$result_query){
            die("Update query failed");
        }
        $_SESSION['message'] = "Consulta actualizada exitosamente";
        $_SESSION['message_type'] = "success";
        header("Location: " . REDIR_VIEWS . "/profesor/ConsultasModBloq.php?p=".$consulta['idProfesor']."&m=".$consulta['idMateria']."&c=".$consulta['idCarrera']);
        exit;
    }
