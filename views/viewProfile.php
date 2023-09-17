<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/usersRepository.php");
require_once(DIR_REPOSITORIES . "/rolesRepository.php");
require_once(DIR_SECURITY);
include(DIR_HEADER);


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("Location: " . REDIR_AUTH . "/login.php");
  exit;
}

$UserRepository = new UserRepository();
$RolRepository = new RoleRepository();
$result = $UserRepository->getUserByIdJoinTables(
  $_SESSION['id'],
  $RolRepository->getEntity(),
  'idRolUsuario',
  $RolRepository->getIdentifier()
)
  ->fetch_array();

?>

<div>


  <section>
    <div class="row text-center m-2">
            <h1> Perfil </h1>
    </div>
    <div class="container py-5">

      <div class="row justify-content-center">

        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Nombre completo</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?= $result['apellido'] ?>, <?= $result['nombre'] ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"> <?= $result['email'] ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Legajo</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?= $result['legajo'] ?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Rol Actual</p>
                </div>
                <div class="col-sm-9">
                  <p class="mb-0"><b><?= strtoUpper($result['descripcionRol']) ?></b></p>
                </div>
              </div>


            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>

<?php include(DIR_FOOTER); ?>