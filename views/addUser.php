<?php include("../partials/header.php");?>

<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Crear Usuario</h1>
        </div>
    </div>
<form action="../controllers/users/addUser.php" method="POST">
    <div class="row justify-content-center">
        <div class="col-md-6 border p-3  bg-light ">
                <div class="form-group mb-3">
                    <input type="text" name="email" class="form-control" 
                    placeholder="Email" autofocus>
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="legajo" class="form-control" 
                    placeholder="Legajo">
                </div>
                <div class="form-group mb-3">
                <select name="tipoUsuario" class="form-control">
                    <option selected>Alumno</option>
                    <option>Profesor</option>
                </select>
                <small class="form-text text-muted">Modificar sólo en el caso de solicitar una cuenta Docente</small>
                </div>
                <input class="btn btn-success btn-block" type="submit" 
                    name="save_user" value="Crear Usuario">
            
        </div>
    </div>
</form>
</div>



<?php include("../partials/footer.php");?>