<?php

if(isset($_POST['user'])){
    include("conexion.php");

    $user = $_POST['user'];

    $sql1 = mysqli_query($conexion, "DELETE FROM `usuarios` WHERE email = '$user'");
    $sql2 = mysqli_query($conexion, "DELETE FROM `misarchivos` WHERE usuario = '$user'");
    $sql3 = mysqli_query($conexion, "DELETE FROM `archivoscompartidos` WHERE remitente = '$user'");
    $nameFolderUSer = substr($user, 0, strlen($user)-strlen(strstr($user, "@")));
    $directorioUser = '../uploads/'.$nameFolderUSer; // Ruta de la carpeta
    
    function eliminarDirectorio($directorio) {
        if (is_dir($directorio)) {
            $archivos = array_diff(scandir($directorio), array('.', '..'));
    
            foreach ($archivos as $archivo) {
                $ruta = $directorio . '/' . $archivo;
    
                if (is_dir($ruta)) {
                    eliminarDirectorio($ruta); // Llamada recursiva para eliminar subcarpetas y sus contenidos
                } else {
                    unlink($ruta); // Eliminar archivo
                }
            }
            rmdir($directorio); // Eliminar la carpeta una vez que se han eliminado todos los archivos y subcarpetas
        }
    }
    
    if($sql1 and $sql2 and $sql3){
        echo json_encode("userDeleted");
        eliminarDirectorio($directorioUser);
    }else{
        echo json_encode("error");
    }
}

?>