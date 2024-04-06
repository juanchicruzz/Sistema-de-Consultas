<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
?>

<header class="p-3 mb-3 border-bottom text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
<!--       <a href="<?= REDIR_INDEX ?>" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
        <img src="<?= REDIR_PARTIALS ?>/utnLogo.png" alt="Home Button" style="width: 50px; height: auto ">
      </a> -->

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="<?= REDIR_INDEX ?>" class="nav-link px-2 link-light">Inicio</a></li>
        <li><a href="<?= REDIR_VIEWS ?>/profesor/ConsultasProfesor.php" class="nav-link px-2 link-light">Mis consultas</a></li>
        <li><a href="<?= REDIR_VIEWS ?>/profesor/ConsultaBloquearSemana.php" class="nav-link px-2 link-light">Bloquear Consulta</a></li>
        <li><a href="<?= REDIR_VIEWS ?>/profesor/ConsultasBloqueadas.php" class="nav-link px-2 link-light">Consultas Bloqueadas</a></li>
      </ul>

      <div class="dropdown text-end">
        <?= $_SESSION['nombre'] . " " . $_SESSION['apellido'] ?>
      </div>
      <div class="dropdown text-end">
        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-label="Dropdown menu de usuario" aria-expanded="false">
          <i class="fa fa-fw fa-user rounded-circle"></i>
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
