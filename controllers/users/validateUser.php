<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/usersRepository.php");

    if(isset($_GET['id'])){
        $UserRepository = new UserRepository();
        $idUsuario = $_GET['id'];
        $result = $UserRepository->validateUser($idUsuario);
        if(!$result){
            die("Validate query failed");
        }
        $_SESSION['message'] = "Usuario Validado exitosamente";
        $_SESSION['message_type'] = "secondary";
        header("Location: " . REDIR_VIEWS . "/admin/validacionDocente.php");
    }

?>