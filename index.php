<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("Location: ". REDIR_AUTH . "/login.php");
    exit;
}
?>
 
<?php require_once(DIR_HEADER);?>

    <div class="container bg-light border">
        <div class="row">
            <h1 class="my-5">Bienvenido al sitio, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b></h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Empezá a navegar por los Horarios de Consultas</h4>
                <a href="<?=REDIR_VIEWS?>/consultas.php" class="btn btn-primary">Comenzar</a>
            </div>
            <div class="col-md-3">

            </div>
            <div class="col-md-3">
            <p>
            <a href="<?=REDIR_AUTH?>/logout.php" class="btn btn-danger ml-3">Cerrar sesión</a>
        </p>
            </div>
        </div>
        <br><br><br> 
    </div>

    <br> <br> 

<?php include(DIR_FOOTER);?>