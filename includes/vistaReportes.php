<?php
include("verificacionLogin.php");
$usuario = $_SESSION['usuario'];
//echo json_encode($usuario["email"]);
if (isset($usuario) and $usuario["email"] == "admin@gmail.com") {
    include("conexion.php");

    $sql = "SELECT username, email, telefono, cedula, ocupacion, rol, seguro FROM usuarios";
    $resultado = $conexion -> query($sql); 
    $arrayUsers = array();
    while($row = mysqli_fetch_assoc($resultado)){
        $user = array();
        array_push($user,$row['username'],$row['email'],$row['telefono'],$row['cedula'],$row['ocupacion'],$row['rol'],$row['seguro']);
        array_push($arrayUsers, $user);
    }
    echo json_encode($arrayUsers);
}else{
    echo json_encode("notAdmin");
}

?>