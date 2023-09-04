<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
?>


<?php require_once(DIR_HEADER);  ?>

<body>
    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1>Formulario de Contacto</h1>
            </div>
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
            } ?>
        </div>
        <form action="<?= REDIR_CONTROLLERS ?>/contactMail.php" method="POST">
            <div class="row justify-content-center">
                <div class="col-md-6 border p-3  bg-light ">
                    <div class="form-group mb-3">
                        <input required type="text" name="asunto" class="form-control" placeholder="Motivo del contacto">
                    </div>
                    <div class="form-group mb-3">
                        <textarea required type="text" name="consulta" class="form-control" placeholder="Cuerpo del mail de consulta"></textarea>
                    </div>
                    <input class="btn btn-success btn-block" type="submit" value="Enviar">

                </div>
            </div>
        </form>
    </div>
</body>

<?php include(DIR_FOOTER); ?>