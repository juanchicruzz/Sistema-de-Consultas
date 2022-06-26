<?php include("../partials/header.php"); ?>

<?php
require_once("../db/rolesRepository.php");
require_once("../db/usersRepository.php");
require_once("../db/materiasRepository.php");
?>
<?php
$UserRepo = new UserRepository();
$RoleRepo = new RoleRepository();
$MateriaRepo = new MateriaRepository();
$users = $UserRepo->getAllUsers();
$roles = $RoleRepo->getAllRoles();
$materias = $MateriaRepo->getAllMaterias();
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
        </div>
    </div>

    <br>
    <br>
</div>
</div>

<?php include("../partials/footer.php"); ?>