<?php

if(isset($_POST["user"] )){
    $user = $_POST["user"];
    include ("conexion.php");
    $arrayFilesSharedWihtMe=[];
    $resultado = mysqli_query($conexion,"SELECT archivo, remitente, permiso FROM archivoscompartidos WHERE receptor = '$user'");
    if ($resultado -> num_rows > 0) {  
        while ($fila = $resultado->fetch_assoc()) {
            $columna1 = $fila["archivo"];
            $columna2 = $fila["remitente"];
            $columna3 = $fila["permiso"];
            $fileShareWithMe = [];
            array_push($fileShareWithMe, $columna1, $columna2, $columna3);
            array_push($arrayFilesSharedWihtMe, $fileShareWithMe);
        }     
    }   
    echo json_encode($arrayFilesSharedWihtMe);
    //echo json_encode($resultado);
}

?>
