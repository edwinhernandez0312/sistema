<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exceptionr;

require ('phpmailer/autoload.php');


$email = new PHPMailer(true);
// try{
// $email->SMTPDebug=SMTP::DEBUG_SERVER;
// $email->isSMTP();
// $email->Host='smtp.gmail.com.';
// $email->SMTPAuth=true;
// $email->Username='sistemas.laurarivera@gmail.com';
// $email->password='Sistemas_cilr';
// $email->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
// $email->Port=587;

// $email->setFrom('sistemas.laurarivera@gmail.com', 'prueba');
// $email->addAddress('eh520856@gmail.com', 'prueba 2');


// $email->isHTML(true);
// }catch(){

// }


?>