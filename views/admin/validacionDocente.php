<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/controllers/security.php");
Security::verifyUserIsAdmin();
// Solo pueden ingresar los admin a esta vista, si es alumno se redirige a login o index

require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
include(DIR_HEADER)

?>
<script src="../tablas/downloadTabla.js"></script>
<?php
include(DIR_REPOSITORIES . "/usersRepository.php");
?>
<div class="container p-4">
    <div class="row bg-light border">
        <h1>Validar Docentes</h1>
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
    <table id='tableValidarDocente' class="table table-bordered">
        <thead class="thead-dark">
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">Legajo</th>
            <th scope="col">Validar</th>
        </thead>
        <tbody>
            <?php
            $UserRepo = new UserRepository();
            $result = $UserRepo->getDocenteNoValidated();
            while ($row = $result->fetch_array()) {
            ?>

                <tr>
                    <td><?= $row['idUsuario'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['legajo'] ?></td>
                    <td>

                        <button aria-label="Boton validar docente" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ValidarDocente" data-bs-idDocente="<?= $row['idUsuario'] ?>" data-bs-mailDocente="<?= $row['email'] ?>">
                            <i class="fa fa-check"></i>
                        </button>
                    </td>
                <?php
            }
                ?>
                </tr>
        </tbody>
    </table>
    <div class="modal fade" id="ValidarDocente" tabindex="-1" aria-labelledby="ValidarDocente" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Validar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= REDIR_CONTROLLERS ?>/users/validateUser.php">
                        <input type="hidden" hidden id="idDocente" name="idDocente">
                        <input type="hidden" hidden id="mail" name="mail">
                        <div class="mb-3">
                            <p>¿Esta seguro que desea validar a: </p>
                            <p id="mailDocente">?</p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Validar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <input class="btn btn-primary" type="button" id="btnExport" value="Descargar PDF" onclick="Export('tableValidarDocente','docentes_a_validar')" />
    <br>
    <br>
</div>

<SCRIPT>
    var validacionDocenteModal = document.getElementById('ValidarDocente');
    validacionDocenteModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var email = button.getAttribute('data-bs-mailDocente');
        var idDocente = button.getAttribute('data-bs-idDocente');
        validacionDocenteModal.querySelector('#mailDocente').textContent = email;
        validacionDocenteModal.querySelector('#idDocente').value = idDocente;
        validacionDocenteModal.querySelector('#mail').value = email;
    });
</SCRIPT>

<?php include(DIR_FOOTER); ?>