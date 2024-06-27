<?php
if(isset($_POST['nickname']) and isset($_POST['email']) and isset($_POST['phone']) and isset($_POST['cedula']) and isset($_POST['ocupattion']) and isset($_POST['rol']) and isset($_POST['seguro'])){
    include("conexion.php");
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $cedula = $_POST['cedula'];
    $ocupattion = $_POST['ocupattion'];
    $rol = $_POST['rol'];
    $seguro = $_POST['seguro'];

    $sql = mysqli_query($conexion,"UPDATE usuarios SET `username`='$nickname',`email`='$email',`telefono`='$phone',`cedula`='$cedula',`ocupacion`='$ocupattion',`rol`='$rol',`seguro`='$seguro' WHERE email = '$email' ");
    if($sql){
        echo json_encode("userUpdated");
    }else{
        echo json_encode("error");
    }
}

?>