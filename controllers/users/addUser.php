<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
    require_once(DIR_REPOSITORIES . "/usersRepository.php");
    require_once(DIR_REPOSITORIES . "/rolesRepository.php");

    if(isset($_POST['save_user'])){
        $UserRepository = new UserRepository();
        $RoleRepository = new RoleRepository();
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $legajo = $_POST['legajo'];
        $idRolUsuario = strtolower($_POST["tipoUsuario"]) == "alumno" ? 1 : 2;
        $password = password_hash($password, PASSWORD_DEFAULT);
        if ($UserRepository->registerUser($email,$password,$legajo,$idRolUsuario,$nombre,$apellido)) 
            {
            $_SESSION['message'] = "Usuario creado exitosamente";
            $_SESSION['message_type'] = "success";
            header("Location: " . REDIR_VIEWS .  "/admin/users.php");
            exit;
        } else {
            echo "Algo salio mal, intente nuevamente.";
            exit;
        }
    }

?>