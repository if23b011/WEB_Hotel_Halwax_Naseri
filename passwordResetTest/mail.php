<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$email = $_GET["mail"];

try {
    //Server settings                   //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Set the SMTP server to send through
    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = 'hoteltropicana42@gmail.com';                     //SMTP username
    $mail->Password = 'wlkk mdxq giot xtge';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('hoteltropicana42@gmail.com', 'Hoteltropicana');
    $mail->addAddress($email);
    $mail->addReplyTo('hoteltropicana42@gmail.com', 'Information');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Change Password';
    $mail->Body = 'Click the link to change your Password: ' . $_GET["url"] . '&validator=' . $_GET["validator"];

    $mail->send();

    echo 'Message has been sent';
    header("Location: index.php?page=resetpassword&reset=success");

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}