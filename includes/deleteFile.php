<?php
    if(isset($_POST["user"]) && isset($_POST["fileToEliminate"])){
        include("conexion.php");
        $user = $_POST["user"];
        $fileToEliminate = $_POST["fileToEliminate"];
        $nameFolderUSer = substr($user, 0, strlen($user)-strlen(strstr($user, "@")));
        $sql = mysqli_query($conexion, "DELETE FROM `misarchivos` WHERE usuario = '$user' AND archivo = '$fileToEliminate'");
        $sql = mysqli_query($conexion, "DELETE FROM `archivoscompartidos` WHERE remitente = '$user' AND archivo = '$fileToEliminate'");
        
        if($sql && unlink('../uploads/'.$nameFolderUSer.'/'.$fileToEliminate)){
           echo json_encode($user);
        }else{
            echo json_encode($user);
        }
    }
?>