<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $servidor = "localhost";
    $username = "root";
    $password = "";
    $dataBase = "bdvalledelulu";
    $conexion= mysqli_connect($servidor,$username,$password,$dataBase) or 
        die("No se ha podido establecer una conexion con la base de datos");

    $sql = mysqli_query($conexion, "SELECT email FROM usuarios");
    
    $carpetaUsuarios = array();
    while ($fila = $sql->fetch_assoc()) {
        $columna1 = $fila["email"];
        array_push($carpetaUsuarios, $columna1);
    }
    
    echo json_encode($carpetaUsuarios);
  }
?>