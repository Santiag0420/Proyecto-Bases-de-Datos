<?php
    if(isset($_POST["faceB64"]) and isset($_POST["user"])){
            // Obtener la imagen base64 enviada
            $base64Image = $_POST['faceB64'];
            $user = $_POST['user'];
            $base64_image = preg_replace('#^data:image/\w+;base64,#i', '', $base64Image);
            
            // Decodificar la imagen base64
            $decodedImage = base64_decode($base64_image);
            // Generar un nombre de archivo único para la imagen
            $basePath = __DIR__;
            // Ruta donde se guardará la imagen en el servidor
            $uploadPath = '../labels/'.$user."/"."0.png";
          
            // Guardar la imagen en el servidor
            file_put_contents($uploadPath, $decodedImage);
          
            // Mostrar mensaje de éxito
           
            echo json_encode("la imagen correcto");
    }else {
        // Mostrar mensaje de error si no se ha enviado una imagen
        echo json_encode('No se ha enviado ninguna imagen.');
    }
?>
