<?php
//ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/consultasRepository.php");
require_once(DIR_REPOSITORIES . "/inscripcionRepository.php");
require_once(DIR_EMAIL_HELPER);

    if(isset($_POST['bloq_consulta'])){
        $inscripcionRepository = new InscripcionRepository();
        $ConsultaRepository = new ConsultaRepository();
        $motivo = strval($_POST['motivo']);
        $idConsulta = $_POST['idConsulta'];
        $consulta = $ConsultaRepository->getConsultaById($idConsulta)->fetch_array();
        $result_query = $ConsultaRepository->bloquearConsulta($motivo,$idConsulta);
        $rowsInscripciones = $inscripcionRepository->getInscripcionesByConsulta($_POST['idConsulta']);
        
        /*
        Mails de los alumnos inscriptos, para mandar mail avisando que la consulta fue bloqueada
        */
        $EmailHelper = new EmailHelper();
        $mails = [];
        while($row = $rowsInscripciones->fetch_array()){
            array_push($mails, $row['email']);
        }
        //array_push($mails, 'acciarrijoshua@gmail.com');
        //array_push($mails, 'juancruzortegacoldorf@gmail.com');
        //array_push($mails, 'francoschiavo7@gmail.com');

        $BODY_MAIL = 'Este mail es a modo informativo. La consulta de la materia ';
        $BODY_MAIL = $BODY_MAIL . '<b>' . $_POST['materia'] . '</b>' . ' - (' . $_POST['profesor'] . ')';
        $BODY_MAIL = $BODY_MAIL . ' en la fecha ' . Utils::convertirFechaFromSQL($_POST['fecha']);
        $BODY_MAIL = $BODY_MAIL . " fue bloqueada. Podes contactarte con tu profesor en caso de ser necesario.";
        $BODY_MAIL = $BODY_MAIL . "<br><br>" . "<b>DEPARTAMENTO DE ALUMNOS - GESTION DE CONSULTAS.</b>";

        $EmailHelper->sendMailMultipleAddress(
            $mails,
            'ATENCION - CONSULTA CANCELADA',
            $BODY_MAIL
        );

        if(!$result_query){
            die("Update query failed");
        }
        $_SESSION['message'] = "Consulta bloqueda exitosamente";
        $_SESSION['message_type'] = "success";
        header("Location: " . REDIR_VIEWS . "/profesor/consultasModBloq.php?p=".$consulta['idProfesor']."&m=".$consulta['idMateria']."&c=".$consulta['idCarrera']);
        exit;
        
    }
