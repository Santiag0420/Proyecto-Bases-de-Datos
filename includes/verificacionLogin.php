<?php
    session_start();
    $servidor = "localhost";
    $username = "root";
    $password = "";
    $dataBase = "bdvalledelulu";
    $conexion= mysqli_connect($servidor,$username,$password,$dataBase) or 
        die("No se ha podido establecer una conexion con la base de datos");
    if(isset($_POST['email'])){
        $arrayRespuesta = array();
        $email = $_POST["email"];
        $passwordVerify = $_POST["password"];
        $consulta = mysqli_query($conexion,"SELECT email, contraseña, verified FROM usuarios WHERE email = '$email'") or 
            die("Problemas con la verificacion");
        $resultado = mysqli_fetch_array($consulta);
        if($email === '' and $passwordVerify === '' ){
            array_push($arrayRespuesta, 'fieldsEmpty', $email);
            echo json_encode($arrayRespuesta);
        }else if(empty($resultado)){
            array_push($arrayRespuesta, 'userNotRegistered', $email);
            echo json_encode($arrayRespuesta);
        }else if($resultado[0] == $email and $resultado[1] != $passwordVerify){
            array_push($arrayRespuesta, 'incorrectPassword', $email);
            echo json_encode($arrayRespuesta);
        }else if($resultado[0] == $email and $resultado[1] == $passwordVerify and $resultado[2] == 1){
            array_push($arrayRespuesta, 'loginSuccessfully', $email);
            echo json_encode($arrayRespuesta);
        }else if($resultado[0] == $email and $resultado[1] == $passwordVerify and $resultado[2] == 0){
            array_push($arrayRespuesta, 'unverifiedUser', $email);
            echo json_encode($arrayRespuesta);
        }
        $_SESSION['usuario'] = $resultado;
        mysqli_close($conexion);
    }
?>
