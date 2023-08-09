<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/usersRepository.php");

$email = $password = $confirm_password = $legajo = "";
$email_err = $password_err = $confirm_password_err = $legajo_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar mail
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor ingrese un email.";
    } elseif (!isEmailValid($_POST["email"])) {
        $email_err = "Por favor ingrese un email valido";
    } else {
        $emailSanitized = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $UserRepository = new UserRepository();
        $result = $UserRepository->getUserByEmail($emailSanitized);
        if ($result->num_rows > 0) {
            $email_err = "Este email ya esta registrado.";
        } else {
            $email = trim($_POST["email"]);
        }
    }

    // Validar password
    if (isset($_POST["password"])) {
        if (empty(trim($_POST["password"]))) {
            $password_err = "Por favor ingrese una contraseña";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "La contraseña debe tener al menos 6 caracteres.";
        } else {
            $password = trim($_POST["password"]);
        }
    }


    // Validar confirm password
    if (isset($_POST["confirm_password"])) {
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Por favor confirma la contraseña";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Las contraseñas no coinciden.";
            }
        }
    }

    // Validar legajo
    $legajo = trim($_POST["legajo"]);
    if (isset($legajo)) {
        if (empty(trim($legajo))) {
            $legajo_err = "Por favor ingrese un legajo";
        } elseif (strlen(trim($legajo)) > 8) {
            $legajo_err = "El legajo no debe ser mayor a 8 caracteres.";
        }
    }

    // Validar que no haya errores
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $legajo = $_POST["legajo"];
        $idRolUsuario = strtolower($_POST["tipoUsuario"]) == "alumno" ? 1 : 2;
        if ($UserRepository->registerUser(
            $email,
            $password,
            $legajo,
            $idRolUsuario
        )) {
            header("Location: " . REDIR_AUTH . "/login.php");
            exit;
        } else {
            echo "Algo salio mal, intente nuevamente.";
        }
    }
}


function isEmailValid($email)
{
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <hr>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-light shadow">
                <h2>Registrarse</h2>
                <p>Por favor complete este formulario para crear su cuenta.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control 
                <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control 
                <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Confirmar Contraseña</label>
                        <input type="password" name="confirm_password" class="form-control 
                <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Legajo</label>
                        <input type="text" name="legajo" class="form-control">
                    </div>
                    <div class="form-group">
                        <select name="tipoUsuario" class="form-control">
                            <option selected>Alumno</option>
                            <option>Profesor</option>
                        </select>
                        <small class="form-text text-muted">Modificar sólo en el caso de solicitar una cuenta Docente</small>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Registrarme">
                        <input type="reset" class="btn btn-secondary ml-2" value="Borrar">
                    </div>
                    <p>¿Ya tenes una cuenta? <a href="login.php">Logueate acá.</a>.</p>
            </div>


            </form>
        </div>
    </div>
    </div>
</body>

</html>