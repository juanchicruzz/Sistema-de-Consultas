<?php include("../partials/header.php");
include("../db/usersRepository.php");
$UserRepository = new UserRepository();
$result = $UserRepository->getUserById($_GET['id'])->fetch_array();
?>

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Modificar Usuario</h1>
        </div>
    </div>
<form action="../controllers/users/editUser.php" method="POST">
    <div class="row justify-content-center">
        <div class="col-md-6 border p-3  bg-light ">
                <div class="form-group mb-3">
                    <input type="text" name="email" class="form-control" 
                    placeholder="Email" autofocus value="<?=$result['email']?>">
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="legajo" class="form-control" 
                    placeholder="Legajo" value="<?=$result['legajo']?>">
                </div>
                <input class="btn btn-success btn-block" type="submit" 
                    name="edit_user" value="Guardar Usuario">
                <input name="idUsuario" hidden value="<?=$_GET['id']?>">
            
        </div>
    </div>
</form>
</div>



<?php include("../partials/footer.php");?>