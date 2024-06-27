<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php'; 
    $template = file_get_contents('../templates/mailTemplate.html');
    $remitente = $_POST["remitente"];
    $mailReeptor= $_POST["receptor"];
    $file = $_POST["file"];
    $clearance = $_POST['clearance'];
    $mail = new PHPMailer(true);
    
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                           //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'proyectobaseunivalle@gmail.com';                     //SMTP username
    $mail->Password   = 'irvlztmvxnxrhruz';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('proyectobaseunivalle@gmail.com', 'Hospital valle de lulu');
    $mail->addAddress($mailReeptor, "sujeto");     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Envio de archivo - Hospital valle de lulu';
    $mail-> Body = '
        <h1>Han compartido un archivo contigo</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodati mat tempor incididunt ut labore et dolore magna aliqua.</p>
        <h2>'.$remitente.' ha compartido un archivo contigo</h2>
    ';
    
    if(!$mail->send()){
        echo json_encode('mailInvalid');
    }else{
        include '../includes/conexion.php';
        $sql = mysqli_query($conexion, "INSERT INTO `archivoscompartidos`(`archivo`, `remitente`, `receptor`, `permiso`) VALUES ('$file','$remitente','$mailReeptor', '$clearance')");
        echo json_encode("fileShareSucessfully");
    }
?>

