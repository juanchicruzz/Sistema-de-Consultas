<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");

require_once(DIR_SECURITY);
Security::verifyUserIsAdmin();

require_once(DIR_REPOSITORIES . "/rolesRepository.php");
require_once(DIR_REPOSITORIES . "/usersRepository.php");
require_once(DIR_REPOSITORIES . "/materiasRepository.php");
require_once(DIR_REPOSITORIES . "/inscripcionRepository.php");


?>
<?php
$UserRepo = new UserRepository();
$RoleRepo = new RoleRepository();
$MateriaRepo = new MateriaRepository();
$InscripcionRepo = new InscripcionRepository();
$users = $UserRepo->getAllUsers();
$roles = $RoleRepo->getAllRoles();
$materias = $MateriaRepo->getAllMaterias();
$inscripciones = $InscripcionRepo->getAllInscripciones();

require_once(DIR_HEADER);
?>

<div class="container p-4">
<div class="row bg-light border">
    <h1>API V1.0</h1>
    <div class="col-md-12 p-4 border">

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#usuarios" aria-controls="usuarios">
                        Usuarios
                    </button>
                </h2>
                <div id="usuarios" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <?php
                        while ($userRow = $users->fetch_assoc()) {
                        ?>
                            <li><?= json_encode($userRow); ?></li>
                        <?php
                        };
                        ?>

                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#roles" aria-expanded="false" aria-controls="roles">
                        Roles
                    </button>
                </h2>
                <div id="roles" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <?php
                        while ($rolRow = $roles->fetch_assoc()) {
                        ?>
                            <li><?= json_encode($rolRow); ?></li>
                        <?php
                        };
                        ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#materias" aria-expanded="false" aria-controls="materias">
                        Materias
                    </button>
                </h2>
                <div id="materias" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <?php
                        while ($materiaRow = $materias->fetch_assoc()) {
                        ?>
                            <li><?= json_encode($materiaRow); ?></li>
                        <?php
                        };
                        ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#inscripciones" aria-expanded="false" aria-controls="inscripciones">
                        Inscripciones
                    </button>
                </h2>
                <div id="inscripciones" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <?php
                        while ($inscRow = $inscripciones->fetch_assoc()) {
                        ?>
                            <li><?= json_encode($inscRow); ?></li>
                        <?php
                        };
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
</div>
</div>

<?php include(DIR_FOOTER); ?>