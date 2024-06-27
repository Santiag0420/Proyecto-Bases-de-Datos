<?php
if(isset($_POST['user'])){
    include("conexion.php");
    $user = $_POST['email'];
    $busqueda = "SELECT archivo FROM archivoscompartidos WHERE receptor = '$user'";

    $resultado = $conexion->query($busqueda);
    if ($resultado -> num_rows > 0) {  
        while ($fila = $resultado->fetch_assoc()) {
            $columna1 = $fila["archivo"];
            array_push($usuarios, $columna1);
        }
    }

    echo json_encode($usuarios);
}
?>