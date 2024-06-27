<?php
    $servidor = "localhost";
    $username = "id20973183_redrum237";
    $password = "Proyecto.base2023";
    $dataBase = "id20973183_bdvalledeluluhost";
    $conexion= mysqli_connect($servidor,$username,$password,$dataBase) or 
        die("No se ha podido establecer una conexion con la base de datos");
?>