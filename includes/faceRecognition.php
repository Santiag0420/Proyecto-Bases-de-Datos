<?php
session_start();
if(isset($_POST['user'])){
    $user = $_POST['user'];
    $_SESSION['usuario'] = $_POST['user'];
    echo json_encode($user);
/* include("conexion.php");
    $user = $_POST['user'];   
    $sql = mysqli_query($conexion,"SELECT contraseña FROM usuarios where email ='$user'"); */
}
?>