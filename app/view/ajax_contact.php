<?php
include(PATH.'/app/src/config.php');
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer();

$message = '<h1>Message envoyé depuis la page Contact</h1>
<p><b>Prénom : </b>' . $_POST['firstname'] . '<br>
<p><b>Nom : </b>' . $_POST['name'] . '<br>
<p><b>Téléphone : </b>' . $_POST['email'] . '<br> <br>
<b>Message : </b>' . htmlspecialchars($_POST['message']) . '</p>';

try{
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.office365.com';               //Adresse IP ou DNS du serveur SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $mailContact;                     //SMTP username
    $mail->Password   = $passwordContact;                               //SMTP password
    $mail->SMTPSecure = 'STARTTLS';            //Enable implicit TLS encryption
    $mail->Port = 587;   

    $mail->setFrom($mailContact, 'Contact de mon portfolio');
    $mail->addAddress('a.diaz@socah.com', 'Envoi Reception');     //Add a recipient

    $mail->isHTML(true);                                  //Mail au format HTML
    $mail->Subject = "Demande de la part de: ".$_POST['name'].' '.$_POST['firstname'];
    $mail->WordWrap = 50; 			                   //Nombre de caracteres pour le retour a la ligne automatique
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->CharSet = 'UTF-8'; //Format d'encodage à utiliser pour les caractères

    $mail->send();
    echo true;

} catch (Exception $e) {
    echo false;
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}