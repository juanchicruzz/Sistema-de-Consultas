<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/security.php");
Security::verifyUserIsAdmin();
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
include(DIR_HEADER);
?>

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Crear Usuario</h1>
        </div>
    </div>
    <form action="<?= REDIR_CONTROLLERS ?>/users/addUser.php" method="POST">
        <div class="row justify-content-center">
            <div class="col-md-6 border p-3  bg-light ">
            <div class="form-group mb-3">
                    <input aria-label="input de texto nombre" type="text" name="nombre" class="form-control" placeholder="Nombre" autofocus>
                </div>
                <div class="form-group mb-3">
                    <input aria-label="input de texto apellido" type="text" name="apellido" class="form-control" placeholder="Apellido">
                </div>
                <div class="form-group mb-3">
                    <input aria-label="input de texto contraseña" type="password" name="password" class="form-control" placeholder="Contraseña">
                </div>
                <div class="form-group mb-3">
                    <input aria-label="input de texto email" type="text" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group mb-3">
                    <input aria-label="input de texto legajo" type="text" name="legajo" class="form-control" placeholder="Legajo">
                </div>
                <div class="form-group mb-3">
                    <select aria-label="seleccionar tipo de usuario" name="tipoUsuario" class="form-control">
                        <option selected>Alumno</option>
                        <option>Profesor</option>
                    </select>
                    <small class="form-text text-muted">Modificar sólo en el caso de crear una cuenta de Profesor</small>
                </div>
                <input class="btn btn-success btn-block" type="submit" name="save_user" value="Crear Usuario">

            </div>
        </div>
    </form>
</div>



<?php include(DIR_FOOTER);; ?>