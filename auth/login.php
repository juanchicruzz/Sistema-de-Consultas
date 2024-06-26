<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/usersRepository.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: " . REDIR_INDEX);
    exit;
}

require_once(DIR_DB . "/config.php");

$email = $password = "";
$email_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // validar email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor ingrese su mail.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Por favor ingrese un mail valido.";
    } else {
        $email = trim($_POST["email"]);
    }

    //validar contraseña
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingrese su contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validar credenciales
    if (empty($email_err) && empty($password_err)) {
        $UserRepository = new UserRepository();
        $result = $UserRepository->getUserByEmail($email);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                // Verificar que si es profesor debe estar validado
                if ($row["idRolUsuario"] == "2" && $row["validado"] == 0) {
                    $login_err = "Su cuenta de profesor se encuentra pendiente de validación.";
                } 
                // Sino se setea todo en sesion para cualquier tipo de usuario
                 else {
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $row["idUsuario"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["userType"] = $row["idRolUsuario"];
                    $_SESSION["nombre"] = $row["nombre"];
                    $_SESSION["apellido"] = $row["apellido"];
                    header("Location: " . REDIR_INDEX);
                    exit;
                }
            } else {
                $login_err = "Credenciales invalidas. Por favor intente de nuevo.";
            }
        } else {
            $login_err = "Credenciales invalidas. Por favor intente de nuevo.";
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="-gIx6uCvgBv2Srzoh_-stK2hFZCQArfoJJIP59pa3Tk" />
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= REDIR_CSS ?>/login.css" type="text/css">
</head>

<body>
    <div class="container login-form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login-form">
            <h2>Login</h2>
            <p>Por favor ingrese sus credenciales para loguearse.</p>
            <?php
            if (!empty($login_err)) {
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
            ?>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input required id="email" type="text" name="email" placeholder="Ingrese su mail" autocomplete="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input required id="password" type="password" name="password" placeholder="Ingrese su contraseña" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </div>
            <p>¿No tenes una cuenta aún? <br> <a href="register.php">Registrate ahora.</a></p>
        </form>
    </div>
</body>

</html>

