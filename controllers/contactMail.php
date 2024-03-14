<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/usersRepository.php");
require_once(DIR_EMAIL_HELPER);
    
$mailConsultas = "sistemaconsultasentornos@gmail.com";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $mail = $_SESSION['email'];
    $EmailHelper = new EmailHelper();
    $idUsuario = $_SESSION['id'];
    $UserRepository = new UserRepository();
    $result = $UserRepository->getUserById($_SESSION['id']);
    $row = $result->fetch_array();
    $EmailHelper->sendMailFrom(
        $mailConsultas,
        "Consulta - ". $_POST['asunto'],
        $_POST['consulta'],
        $mail,
        $row['nombre']." ".$row['apellido'],
    );
    $_SESSION['message'] = "Consulta enviada correctamente. Mail enviado a ". $mailConsultas ;
    $_SESSION['message_type'] = "success";
    header("Location: " . REDIR_VIEWS . "/contacto.php");
    }
