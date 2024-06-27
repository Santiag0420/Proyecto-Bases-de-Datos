<?php
if(isset($_POST["user"]) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    include("conexion.php");
    $arrayA = array();
    $user = $_POST["user"];
    $fileName = $_POST['nameFile'];
    $updatedNameFile = $_POST['updatedNameFile'];
    $fileType = $_POST['fileType'];
    $nameFolderUSer = substr($user, 0, strlen($user)-strlen(strstr($user, "@")));

    array_push($arrayA, $user, $fileName, $updatedNameFile, $fileType);
    $sql = mysqli_query($conexion,"UPDATE `misarchivos` SET archivo='$updatedNameFile.$fileType' WHERE usuario = '$user' AND archivo = '$fileName'");
    $sql2 = mysqli_query($conexion,"UPDATE `archivoscompartidos` SET archivo='$updatedNameFile.$fileType' WHERE remitente = '$user' AND archivo = '$fileName'");
    $fileName = substr($fileName, 0, strlen($fileName)-strlen(strstr($fileName, ".")));
    rename('../uploads/'.$nameFolderUSer.'/'.$fileName.".".$fileType, '../uploads/'.$nameFolderUSer.'/'.$updatedNameFile.".".$fileType);
    if($sql and $sql2){
        echo json_encode("updateSucessfully");
    }else{
        echo json_encode("updateFailed");
    }

}
?>



