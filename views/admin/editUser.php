<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/security.php");
Security::verifyUserIsAdmin();
// Solo pueden ingresar los admin a esta vista, si es alumno se redirige a login o index
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");

include(DIR_REPOSITORIES . "/usersRepository.php");

$UserRepository = new UserRepository();
$result = $UserRepository->getUserById($_GET['id'])->fetch_array();

include(DIR_HEADER);
?>

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Modificar Usuario</h1>
        </div>
    </div>
<form action="<?=REDIR_CONTROLLERS?>/users/editUser.php" method="POST">
    <div class="row justify-content-center">
        <div class="col-md-6 border p-3  bg-light ">
                <div class="form-group mb-3">
                    <input type="text" name="email" class="form-control" 
                    placeholder="Email" autofocus value="<?=$result['email']?>">
                </div>
                <div class="form-group mb-3">
                    <input type="number" name="legajo" class="form-control" 
                    placeholder="Legajo" value="<?=$result['legajo']?>">
                </div>
                <input class="btn btn-success btn-block" type="submit" name="edit_user" value="Actualizar Usuario">
                <input type="button" class="btn btn-secondary btn-block" onclick="history.back()" name="Volver atrás" value="Volver atrás">
                <input name="idUsuario" type="hidden" hidden value="<?=$_GET['id']?>">
            
        </div>
    </div>
</form>
</div>



<?php include(DIR_FOOTER);?>