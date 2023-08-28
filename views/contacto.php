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
    </div>
    <form action="" method="POST">
        <div class="row justify-content-center">
            <div class="col-md-6 border p-3  bg-light ">
                <div class="form-group mb-3">
                    <input required type="text" name="asunto" class="form-control" placeholder="Motivo del contacto">
                </div>
                <div class="form-group mb-3">
                    <textarea required type="text" name="consulta" class="form-control" placeholder="Cuerpo del mail de consulta"></textarea>
                </div>
                <input class="btn btn-success btn-block" type="submit" id="enviarContacto" name="enviarContacto" value="Enviar">

            </div>
        </div>
    </form>
</div>
</body>

<?php include(DIR_FOOTER); ?>