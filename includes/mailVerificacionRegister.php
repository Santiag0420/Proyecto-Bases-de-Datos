<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php'; 
$template = file_get_contents('../templates/mailTemplate.html');
    $mailUser = $_POST["mail"];
    $user = $_POST["user"];
    $contraseña= $_POST["password"];
    $telefono= $_POST["phone"];
    $cedula= $_POST["id"];
    $ocupacion= $_POST["ocupation"];
    $seguro= $_POST["lifeInsurance"];
    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
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
    $mail->addAddress($mailUser, $user);     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verificacion Hospital valle de lulu';
    $mail-> Body = '
        <h1>bienvenido su codigo de verificacion es esta</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodati mat tempor incididunt ut labore et dolore magna aliqua.</p>
        <h2>'.$code.'</h2>
    ';
    
    if(!$mail->send()){
        echo json_encode('mailInvalid');
    }else{
        include '../includes/conexion.php';
        if(isset($_POST['ADMIN'])){
            $registrarUsuario = mysqli_query($conexion, "INSERT INTO usuarios(username, email, contraseña, telefono, cedula, ocupacion, rol, seguro, code, verified) 
            VALUES('$user', '$mailUser','$contraseña','$telefono','$cedula','$ocupacion', 'Predeterminado','$seguro', '$code', 1)");
            echo json_encode('mailSend');
        }else{
            /* $nameFolderUSer = substr($mailUser, 0, strlen($mailUser)-strlen(strstr($mailUser, "@")));
            $folderUser = "../labels/".$nameFolderUSer;
            if(!(file_exists($folderUser) && is_dir($folderUser))){
                mkdir($folderUser);
            } */
            $registrarUsuario = mysqli_query($conexion, "INSERT INTO usuarios(username, email, contraseña, telefono, cedula, ocupacion, rol, seguro, code, verified) 
            VALUES('$user', '$mailUser','$contraseña','$telefono','$cedula','$ocupacion', 'Predeterminado','$seguro', '$code', 0)");
            echo json_encode('mailSend');
        }
        
    }
?>

