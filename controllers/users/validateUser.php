<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require_once(DIR_REPOSITORIES . "/usersRepository.php");
require_once(DIR_EMAIL_HELPER);

    if(isset($_POST['idDocente'])){
        $EmailHelper = new EmailHelper();
        $UserRepository = new UserRepository();
        $idDocente = $_POST['idDocente'];
        $mail = $_POST['mail'];
        $result = $UserRepository->validateUser($idDocente);
        
        if(!$result){
            die("Validate query failed");
        }
        $EmailHelper->sendMail(
            $mail,
            'EMAIL DE PROFESOR VALIDADO',
            'Te contactamos para confirmar que tu cuenta de Profesor fue validada con éxito.'
        );
        $_SESSION['message'] = "Docente Validado exitosamente. Mail enviado";
        $_SESSION['message_type'] = "success";
        header("Location: " . REDIR_VIEWS . "/admin/validacionDocente.php");
    }

?>