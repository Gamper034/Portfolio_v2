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
    $mail->Username   = 'anthony.diaz@esicad.org';                     //SMTP username
    $mail->Password   = 'FP6R3iD6';                               //SMTP password
    $mail->SMTPSecure = 'STARTTLS';            //Enable implicit TLS encryption
    $mail->Port = 587;   

    $mail->setFrom('anthony.diaz@esicad.org', 'Contact de mon portfolio');
    $mail->addAddress('a.diaz@socah.com', 'Envoi Reception');     //Add a recipient

    $mail->isHTML(true);                                  //Mail au format HTML
    $mail->Subject = "Demande de la part de: ".$_POST['name'].' '.$_POST['firstname'];
    $mail->WordWrap = 50; 			                   //Nombre de caracteres pour le retour a la ligne automatique
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->CharSet = 'UTF-8'; //Format d'encodage à utiliser pour les caractères

    $mail->send();
    echo 'Message has been sent';
    $arrayMail = array(
        'isDone' => 1,
        "message" => 'Votre demande a bien été envoyée.'
    );
    echo json_encode($arrayMail);

} catch (Exception $e) {
    $arrayMail = array(
        'isDone' => 0,
        "message" => 'Votre demande n\' pu aboutir. Veuillez réessayer ultérieurement.'
    );
    echo json_encode($arrayMail);
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}