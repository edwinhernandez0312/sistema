<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$email = new PHPMailer(true);
try{
$email->SMTPDebug=SMTP::DEBUG_SERVER;
$email->isSMTP();
$email->Host='smtp.gmail.com.';
$email->SMTPAuth=true;
$email->Username='sistemas.laurarivera@gmail.com';
$email->Password='fnbrytzzwwqhrcml';
$email->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
$email->Port=587;

$email->setFrom('sistemas.laurarivera@gmail.com', 'prueba');
$email->addAddress('eh520856@gmail.com', 'prueba 2');


$email->isHTML(true);
$email->Subject='prueba de correo';
$email->Body ='Esta en una prueba de <b>correo</b>';
$email->send();

echo "correo enviado";
}catch(Exception $e){
echo "Mensaje".$email->ErrorInfo;
}


?>