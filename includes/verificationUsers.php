<?php
    $email = $_POST['email'];
    $code = $_POST['code'];
    include '../includes/conexion.php';

    $consulta = mysqli_query($conexion, "SELECT `code` FROM `usuarios` WHERE email = '$email'") or 
        die(mysqli_error($conexion));
    $resultado = mysqli_fetch_array($consulta); 
    if($code===''){
        echo json_encode("fieldsEmpty");
    }else if(empty($resultado)){
        echo json_encode("verificationFailed");
    }else if($resultado[0] === $code){
        $cambio = mysqli_query($conexion, "UPDATE `usuarios` SET `verified` = 1 WHERE email = '$email' ") or 
            die(mysqli_error($conexion)); 
        echo json_encode("verificationSucessfully");
    }
?>