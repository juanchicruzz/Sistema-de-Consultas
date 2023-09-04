<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once($_SERVER['DOCUMENT_ROOT'] . "/directories.php");
require DIR_PHPMAILER .'/vendor/autoload.php';
require_once('credentials.php');

class EmailHelper{


static function getEmailHelper(){
    $MailHelper = self::initHelperInstance();
    return $MailHelper;
}

private static function initHelperInstance(){
    try {
        $mailHelper = new PHPMailer(true);
        //Server settings
        $mailHelper->isSMTP();                                            //Send using SMTP
        $mailHelper->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mailHelper->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mailHelper->Username   = SMTP_USERNAME;                     //SMTP username
        $mailHelper->Password   = SMTP_PASSWORD;                               //SMTP password
        $mailHelper->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mailHelper->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mailHelper->setFrom("sistemaconsultasentornos@gmail.com", 'Grupo 5 - EG - 2022');
        return $mailHelper;    
    }catch (Exception $e) {
            echo "Error: ".$mailHelper->ErrorInfo. " " .$e;
    }
}

public function sendMail($addressTo, $subject, $body){
    $mailHelper = self::getEmailHelper();
    try{
        $mailHelper->isHTML(true);
        $mailHelper->addAddress($addressTo);
        $mailHelper->Subject = $subject;
        $mailHelper->Body    = $body;
        $mailHelper->send();
        echo "Mail enviado exitosamente";
    }catch(Exception $e){
        echo "Error al enviar el mail. PHPMailer Error: " . $mailHelper->ErrorInfo;
    }
}

public function sendMailMultipleAddress(array $addresses, $subject, $body){
    $mailHelper = self::getEmailHelper();
    try{
        $mailHelper->isHTML(true);
        $mailHelper->Subject = $subject;
        $mailHelper->Body    = $body;
        foreach($addresses as $address){
            $mailHelper->addAddress($address);
        }
        $mailHelper->send();
        echo "Mail enviado exitosamente";
    }catch(Exception $e){
        echo "Error al enviar el mail. PHPMailer Error: " . $mailHelper->ErrorInfo;
    }

}

public function sendMailFrom($addressTo, $subject, $body, $from, $name){
    $mailHelper = self::getEmailHelper();
    try{
        $mailHelper->isHTML(true);
        $mailHelper->addAddress($addressTo);
        $mailHelper->Subject = $subject;
        $mailHelper->Body    = $body;
        $mailHelper->addReplyTo($from,$name);
        $mailHelper->send();
        echo "Mail enviado exitosamente";
    }catch(Exception $e){
        echo "Error al enviar el mail. PHPMailer Error: " . $mailHelper->ErrorInfo;
    }
}



}


?>
