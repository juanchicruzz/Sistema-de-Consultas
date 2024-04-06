<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
?>

<header class="p-3 mb-3 border-bottom">
  <div class="container-fluid no-padding">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

      <div class="col-1"></div>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="<?= REDIR_INDEX ?>" class="nav-link px-2 link-light">Inicio</a></li>
        <li><a href="<?= REDIR_VIEWS ?>/consultas.php" class="nav-link px-2 link-light">Consultas</a></li>
        <li><a href="<?= REDIR_VIEWS ?>/alumno/misInscripciones.php" class="nav-link px-2 link-light">Mis Inscripciones</a></li>
      </ul>

      <div class="dropdown text-end link-light">
        <?=$_SESSION['nombre'] . " " . $_SESSION['apellido'] ?>
      </div>
      <div class="dropdown text-end">
        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" aria-label="Dropdown menu opciones usuario" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-fw fa-user rounded-circle" ></i>
        </a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
          <li class="dropdown-item"><strong><?= $_SESSION['email'] ?></strong></li>
          <li><a class="dropdown-item" href="<?= REDIR_VIEWS ?>/viewProfile.php">Perfil</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="<?= REDIR_AUTH ?>/logout.php">Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>
