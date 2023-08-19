<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: " . REDIR_AUTH . "/login.php");
    exit;
}
?>

<?php require_once(DIR_HEADER); ?>

<style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    /* Estilos para el contenido principal */
    .container {
        min-height: 72.8%;
        margin-bottom: -30px;
        padding-bottom: 50px;
    }
</style>

<div class="container">
    <div class="row">
        <h1 class="my-5">Bienvenido al sitio! <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b></h1>
    </div>
    <div class="row">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Empezá a navegar por los Horarios de Consultas</h4>
                <a href="<?= REDIR_VIEWS ?>/consultas.php" class="btn btn-primary">Ver Horarios</a>
            </div>
            <hr>
        </div>
    </div>
</div>
<?php include(DIR_FOOTER); ?>