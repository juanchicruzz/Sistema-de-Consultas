<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_SECURITY);

// Solo pueden ingresar los admin a esta vista, si es alumno se redirige a login o index
Security::verifyUserIsAdmin();
// 
include(DIR_HEADER)

?>

<?php
include(DIR_REPOSITORIES . "/usersRepository.php");
?>
<div class="container p-4">
    <div class="row bg-light border">
        <h1>Usuarios</h1>
        <div class="col-md-6 p-4">
            <a href="addUser.php" class="btn btn-success">Agregar Usuario</a>
        </div>
    </div>
    <br>
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?>
                alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    <?php
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    }
    ?>
    <br>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">Legajo</th>
            <th scope="col">Rol</th>
            <th scope="col">Acciones</th>
        </thead>
        <tbody>
            <?php
            $UserRepo = new UserRepository();
            $result = $UserRepo->getAllUsers();
            while ($row = $result->fetch_array()) {
                $validado = "";
                if ($row['descripcionRol'] == "profesor") {
                    $idValidado = $row['validado'];
                    $validado = $idValidado == 1 ? " VALIDADO" : " NO VALIDADO";
                }

            ?>

                <tr>
                    <td><?= $row['idUsuario'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['legajo'] ?></td>
                    <td><?= strtoupper($row['descripcionRol']) ?><?= $validado ?></td>
                    <td>
                        <a href="editUser.php?id=<?= $row['idUsuario'] ?>" class="btn btn-warning">
                            <i class="fas fa-pen"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#EliminarUsrModal" data-bs-email="<?= $row['email'] ?>" data-bs-idusuario="<?= $row['idUsuario'] ?>">
                            <i class="fas fa-trash "></i>
                        </button>
                    </td>
                </tr>
            <?php
                $validado = "";
            }
            ?>
        </tbody>
    </table>

    <div class="modal fade" id="EliminarUsrModal" tabindex="-1" aria-labelledby="EliminarUsrModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?= REDIR_CONTROLLERS ?>/users/deleteUser.php?">
                    <div class="modal-body">
                        <div class="mb-3">
                            <p><strong> Esta seguro que desea eliminar a :</strong></p>
                            <p id="emailModal" style="font-weight:bold;"></p>
                            <input hidden id="idUsuarioModal" name="idUsuario">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<SCRIPT>
    var EliminarUsrModal = document.getElementById('EliminarUsrModal');
    EliminarUsrModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var email = button.getAttribute('data-bs-email');
        var idUsuario = button.getAttribute('data-bs-idusuario');
        EliminarUsrModal.querySelector('#emailModal').textContent = email;
        EliminarUsrModal.querySelector('#idModal').textContent = idUsuario;
        document.getElementById('idUsuarioModal').value = idUsuario;
    });
</SCRIPT>

<?php include(DIR_FOOTER); ?>