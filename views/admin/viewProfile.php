<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/usersRepository.php");
require_once(DIR_SECURITY);
Security::verifyUserIsAdmin();
include(DIR_HEADER);

$UserRepository = new UserRepository();
$result = $UserRepository->getUserById($_SESSION['id'])->fetch_array();

?>

<section>
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
                <p class="text-muted mb-0"><?=$result['apellido']?>, <?=$result['nombre']?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"> <?=$result['email']?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Legajo</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?=$result['legajo']?></p>
              </div>
            </div>


          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php include(DIR_FOOTER);?>