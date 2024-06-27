<?php
if(isset($_POST['remitente']) && isset($_POST['receptor']) && isset($_POST['file'])){
    include("conexion.php");
    $remitente =$_POST['remitente'];
    $receptor = $_POST['receptor'];
    $file = $_POST['file'];
    
    $usuarios = array();
    $busqueda = "SELECT email FROM `usuarios`";
    $resultado = $conexion->query($busqueda);
    if ($resultado -> num_rows > 0) {  
        while ($fila = $resultado->fetch_assoc()) {
            $columna1 = $fila["email"];
            array_push($usuarios, $columna1);
        }
    }
    $busqueda2 = mysqli_query($conexion,"SELECT archivo, remitente, receptor FROM `archivoscompartidos` WHERE remitente = '$remitente' AND receptor = '$receptor' AND archivo = '$file'");
    $busquedaCompartidos = mysqli_fetch_array($busqueda2);

    if($remitente == $receptor){
        echo json_encode("fileShareWithYourself");
    }else if(!(empty($busquedaCompartidos) or is_null($busquedaCompartidos))){
        echo json_encode("fileAlreadyShare");
    }else if(in_array($receptor, $usuarios)){
        echo json_encode("sendMail");
    }else{
        echo json_encode("userNotFound");
    }
    //echo json_encode($busquedaCompartidos);
    
}else{
    echo json_encode("pillo");
}
?>