<?php


if(isset($_POST["user"])){
    include("conexion.php");
    $user = $_POST["user"];
    $arrayMyFiles=[];
    $busqueda = "SELECT archivo FROM misarchivos WHERE usuario = '$user'";
    $resultado = $conexion->query($busqueda);

    if ($resultado -> num_rows > 0) {  
        while ($fila = $resultado->fetch_assoc()) {
            $columna1 = $fila["archivo"];
            array_push($arrayMyFiles, $columna1);
        }
    }
    echo json_encode($arrayMyFiles);
}

?>