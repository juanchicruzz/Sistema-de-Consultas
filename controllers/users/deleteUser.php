<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/usersRepository.php");

    if(isset($_POST['idUsuario'])){
        $UserRepository = new UserRepository();
        $idUsuario = $_POST['idUsuario'];
        $result = $UserRepository->deleteUser($idUsuario); 
        if(!$result){
            die("Delete query failed");
        }
        $_SESSION['message'] = "Usuario eliminado exitosamente";
        $_SESSION['message_type'] = "success";
        header("Location: " . REDIR_VIEWS . "/admin/users.php");
        exit;
    }

?>