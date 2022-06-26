<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/consultasRepository.php");

    if(isset($_POST['desbloqSemana_consulta'])){
        $ConsultaRepository = new ConsultaRepository();
        $fechaInicio = $_POST['StartDate'];
        $fechaFin = $_POST['EndDate'];
        $idProfesor = $_POST['idProfesor'];
        echo $fechaInicio . " " . $fechaFin;

        $consultas = $ConsultaRepository->getConsultasByDates('Bloqueada',$idProfesor,$fechaInicio,$fechaFin);

        if($consultas -> num_rows == 0){
            $_SESSION['message'] = "No se encontraron consultas para desbloqueare entre las fechas seleccionadas";
            $_SESSION['message_type'] = "warning";
            header("Location: " . REDIR_VIEWS . "/profesor/ConsultasBloqueadas.php");
            exit;
        }

      
        $result_query = $ConsultaRepository->desbloqConsultasByDate($idProfesor,$fechaInicio, $fechaFin); 
        if(!$result_query){
            die("Update query failed");
        }
        $_SESSION['message'] = "Consultas desbloqueadas exitosamente";
        $_SESSION['message_type'] = "success";
        header("Location: " . REDIR_VIEWS . "/profesor/ConsultasBloqueadas.php");
        exit;
    }
