<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
    require_once(DIR_REPOSITORIES . "/usersRepository.php");
    require_once(DIR_REPOSITORIES . "/rolesRepository.php");

    if(isset($_POST['save_user'])){
        $UserRepository = new UserRepository();
        $RoleRepository = new RoleRepository();
        $email = $_POST['email'];
        $legajo = $_POST['legajo'];
        $tipoUsuario = $_POST['tipoUsuario'];
        $result = $RoleRepository->
            getRoleByDescription(strtolower($_POST['tipoUsuario']));
        $idRol = $result->fetch_array()['idRol'];   
        $result_query = $UserRepository->createSimpleUser($email, $legajo, $idRol); 
        if(!$result_query){
            die("Insert query failed");
        }
        $_SESSION['message'] = "Usuario creado exitosamente";
        $_SESSION['message_type'] = "success";
        header("Location: " . REDIR_VIEWS .  "/admin/users.php");
        exit;
    }

?>