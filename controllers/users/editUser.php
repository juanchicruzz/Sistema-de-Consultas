<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/usersRepository.php");

function hasNewData($idUsuario, $email, $legajo){
    $UserRepository = new UserRepository();
    $result = $UserRepository->getUserById($idUsuario)->fetch_array();
    return $result['email'] != $email || $result['legajo'] != $legajo;
}

    if(isset($_POST['edit_user'])){
        $UserRepository = new UserRepository();
        $email = $_POST['email'];
        $legajo = $_POST['legajo'];
        $idUsuario = $_POST['idUsuario'];
        if(!hasNewData($idUsuario, $email, $legajo)){
            $_SESSION['message'] = "No se realizaron cambios en el usuario";
            $_SESSION['message_type'] = "warning";
            header("Location: " . REDIR_VIEWS . "/admin/users.php");
            exit;
        }
        $result_query = $UserRepository->updateUser($email, $legajo, $idUsuario); 
        if(!$result_query){
            die("Update query failed");
        }
        $_SESSION['message'] = "Usuario actualizado exitosamente";
        $_SESSION['message_type'] = "warning";
        header("Location: " . REDIR_VIEWS . "/admin/users.php");
        exit;
    }

?>