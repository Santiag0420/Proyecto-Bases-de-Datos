<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
  include("conexion.php");
  $usuario = $_POST["email"];
  $files = $_FILES['files'];
  $fechaSubida = $_POST['fechaSubida'];
  $uploadedFiles = [];
  $arrayMyFiles = array();
  $validFiles = array(
    "octet-stream" => "sql",
    "mpeg" => "mp3",
    "zip" => "zip",
    "gif" => "gif",
    "pdf" => "pdf",
    "mp4" => "mp4",
    "plain" => "txt",
    "png" => "png",
    "jpeg" => "jpeg",
    "jpg" => "jpg"
  );

  $nameFolderUSer = substr($usuario, 0, strlen($usuario)-strlen(strstr($usuario, "@")));
  $folderUser = "../uploads/".$nameFolderUSer;
  if(!(file_exists($folderUser) && is_dir($folderUser))){
    mkdir($folderUser);
  }
  $busqueda="SELECT archivo FROM misarchivos where usuario = '$usuario'";
  // Ejecutar consulta
  $resultado = $conexion->query($busqueda);
  
  // Verificar si hay resultados
  if ($resultado -> num_rows > 0) {  
    while ($fila = $resultado->fetch_assoc()) {
      $file = array();
      $columna1 = $fila["archivo"];
      array_push($file, explode(".",$columna1)[0],explode(".",$columna1)[1]);
      array_push($arrayMyFiles,$file);
    }
  }
  for ($i = 0; $i < count($files['name']); $i++) {
    $uploadFile = true;
    $fileName = substr($files['name'][$i], 0, strlen($files['name'][$i])-strlen(strstr($files['name'][$i], ".")));
    $fileType = substr($files['type'][$i], strlen($files['type'][$i])-strlen(strstr($files['type'][$i], "/"))+1);
    $fileTmpPath = $files['tmp_name'][$i];
    $fileSize = $files['size'][$i];
    $fileError = $files['error'][$i];
    if(array_key_exists($fileType, $validFiles)){
      if(!empty($arrayMyFiles)){
        for ($i = 0; $i < count($arrayMyFiles); $i++) {
          if($fileName == $arrayMyFiles[$i][0] and $fileType == $arrayMyFiles[$i][1]){
            $uploadFile = false;
            break;
          }else{
            $uploadFile = true;
          }
        }
        if($uploadFile){
          array_push($uploadedFiles, $fileName.".".$fileType);
          $destination = '../uploads/'.$nameFolderUSer.'/'.$fileName.'.'.$validFiles[$fileType];
          $busqueda = mysqli_query($conexion,"INSERT INTO `misarchivos`(`usuario`, `archivo`,`fecha`) VALUES ('$usuario','$fileName.$validFiles[$fileType]','$fechaSubida')") or die("erorr al subir archivo");
          move_uploaded_file($fileTmpPath, $destination);
          array_push($uploadedFiles, "fileUploadSucessfully");
        }else{
          array_push($uploadedFiles, "fileUploadError");
        }
      }else{
        $uploadFile = true;
        array_push($uploadedFiles, $fileName.".".$fileType);
        $destination = '../uploads/'.$nameFolderUSer.'/'.$fileName.'.'.$validFiles[$fileType];
        $busqueda = mysqli_query($conexion,"INSERT INTO `misarchivos`(`usuario`, `archivo`, `fecha`) VALUES ('$usuario','$fileName.$validFiles[$fileType]','$fechaSubida')") or die("erorr al subir archivo");
        move_uploaded_file($fileTmpPath, $destination);
        array_push($uploadedFiles, "fileUploadSucessfully");
      }
    }else{
      array_push($uploadedFiles, null);
      array_push($uploadedFiles, "fileTypeInvalid");
    } 
    array_push($uploadedFiles, $fileTmpPath, $fileName);
  }
    
  define("RESPONSE","uploadSucessfully");
  echo json_encode($uploadedFiles); 
}
?>