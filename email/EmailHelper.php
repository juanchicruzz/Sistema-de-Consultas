<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require DIR_PHPMAILER .'/vendor/autoload.php';
require_once('credentials.php');

class EmailHelper{

protected static $HELPER;

private static function EmailHelperInstance(){
    if(!isset(self::$HELPER)){
        self::initHelperInstance();
    }
        return self::$HELPER;
}

private static function initHelperInstance(){
    try {
        self::$HELPER = new PHPMailer(true);
        //Server settings
        self::$HELPER->isSMTP();                                            //Send using SMTP
        self::$HELPER->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        self::$HELPER->SMTPAuth   = true;                                   //Enable SMTP authentication
        self::$HELPER->Username   = SMTP_USERNAME;                     //SMTP username
        self::$HELPER->Password   = SMTP_PASSWORD;                               //SMTP password
        self::$HELPER->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        self::$HELPER->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        self::$HELPER->setFrom('sistemaconsultasentornos@gmail.com', 'Grupo 5 - EG - 2022');
        }catch (Exception $e) {
            echo "Error: ".self::$HELPER->ErrorInfo. " " .$e;
    }
}

public function sendMail($addressTo, $subject, $body){
    try{
        $this->EmailHelperInstance()->isHTML(true);
        $this->EmailHelperInstance()->addAddress($addressTo);
        $this->EmailHelperInstance()->Subject = $subject;
        $this->EmailHelperInstance()->Body    = $body;
        $this->EmailHelperInstance()->send();
        echo "mail enviado exitosamente";
    }catch(Exception $e){
        echo "Error al enviar el mail. PHPMailer Error: " . $this->EmailHelperInstance()->ErrorInfo;
    }
}



}


?>
