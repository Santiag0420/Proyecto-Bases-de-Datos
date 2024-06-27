<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST["email"];
    include("conexion.php");

    $busqueda="SELECT archivo FROM misarchivos where usuario = '$usuario'";

    // Ejecutar consulta
    $resultado = $conexion->query($busqueda);
    $arrayMyFiles = array();  
    // Verificar si hay resultados
    if ($resultado -> num_rows > 0) {  
        while ($fila = $resultado->fetch_assoc()) {
            $columna1 = $fila["archivo"];
            array_push($arrayMyFiles, $columna1);
        }
        echo json_encode($arrayMyFiles);
    }else{
        echo json_encode("FilesNotFound");
    }
}
?>

