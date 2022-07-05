<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_SECURITY);

// Solo pueden ingresar los admin a esta vista, si es alumno se redirige a login o index
Security::verifyUserIsAdmin();
// 
include(DIR_HEADER)

?>
<script type="text/javascript" charset="utf8" src="../tablas/downloadTabla.js"></script>
<?php
    include(DIR_REPOSITORIES . "/usersRepository.php");
?>
    <div class="container p-4">
        <div class="row bg-light border">
            <h1>Validar Docentes</h1>   
        </div>
        <br>
        <?php
            if(isset($_SESSION['message'])){
        ?>
            <div class="alert alert-<?=$_SESSION['message_type']?>
                alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>    
        <?php
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            }
        ?>
        <br>
       <table id='tableValidarDocente' class="table table-bordered">
           <thead class="thead-dark">
               <th scope="col">ID</th>
               <th scope="col">Email</th>
               <th scope="col">Legajo</th>
               <th scope="col">Validar</th>
           </thead>
           <tbody>
            <?php
                $UserRepo = new UserRepository();
                $result = $UserRepo->getDocenteNoValidated();
                while($row = $result->fetch_array()){
            ?>

                <tr>
                    <td><?=$row['idUsuario']?></td>
                    <td><?=$row['email']?></td>
                    <td><?=$row['legajo']?></td>
                    <td align="center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ValidarDocente" data-bs-whatever="@mdo">
                            <i class="fa fa-check"></i>
                        </button>
                        <div class="modal fade" id="ValidarDocente" tabindex="-1" aria-labelledby="ValidarDocente" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Validar Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="<?=REDIR_CONTROLLERS?>/users/validateUser.php?id=<?=$row['idUsuario']?>">
                                            <div class="mb-3">
                                                <p><strong> Esta seguro que desea validar a: </strong><?=$row['email']?></p>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Validar</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php
                }
            ?>
           </tbody>
       </table>
       <input class="btn btn-primary" type="button" id="btnExport" value="Descargar PDF" onclick="Export('tableValidarDocente','docentes_a_validar')" />
       <br>
       <br>
    </div>

<?php include(DIR_FOOTER);?>
