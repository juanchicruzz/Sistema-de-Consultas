<?php
ini_set('display_errors', 1);
require_once('EmailHelper.php');

    
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    $EmailHelper =  new EmailHelper();
    $EmailHelper->sendMail(
        'acciarrijoshua@gmail.com',
        'ASUNTO DEL MAIL',
        'CUERPO DEL MAIL, <br> SE PUEDE PASAR UN HTML <b>JOSHUA</b>'
    );
    $EmailHelper->sendMailMultipleAddress(
        ['acciarrijoshua@gmail.com', 'joshynob@gmail.com'], 
        'ASUNTO - MULTIPLE MAIL',
        'CUERPO DEL MAIL <b>JOSHUA</b>'
    );
