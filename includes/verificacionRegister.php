<?php
$servidor = "localhost";
$username = "root";
$password = "";
$dataBase = "bdvalledelulu";
$conexion = mysqli_connect($servidor, $username, $password, $dataBase) or
    die("No se ha podido establecer una conexion con la base de datos");


$user = $_POST["username"];
$email = $_POST["email"];
$contraseña= $_POST["password"];
$telefono= $_POST["telephone"];
$cedula = $_POST["id"];
$ocupacion = $_POST["ocupation"];
$seguro = $_POST["seguro"];



$passwordVerify = $_POST["password"];
$consulta = mysqli_query($conexion, "SELECT email, username FROM usuarios WHERE email = '$email' or username = '$user'") or
    die("Problemas con la verificacion");
$resultado = mysqli_fetch_array($consulta);
if(empty($_POST["username"]) or empty($_POST["password"]) or empty($_POST["email"]) or empty($_POST["id"])
    or empty($_POST["telephone"]) or empty($_POST["ocupation"]) or empty($_POST["seguro"])) {
        $responseServer = array(
            'response'=> 'fieldsEmpty'
        );
    echo json_encode($responseServer);
}else if (empty($resultado)) {
    $responseServer = array(
        'mail'=> $email,
        'user' => $user,
        'password' => $contraseña,
        'phone' => $telefono,
        'id' => $cedula,
        'ocupation' => $ocupacion,
        'lifeInsurance' => $seguro,
        'response'=> 'verifyUser'
    );
    echo json_encode($responseServer);
}else if($email == $resultado[0]){
    $responseServer = array(
        'response'=> 'emailRegistered'
    );
    echo json_encode($responseServer);
}else if($user == $resultado[1]){
    $responseServer = array(
        'response'=> 'userRegistered'
    );
    echo json_encode($responseServer);
} else{ echo json_encode("hola");}

mysqli_close($conexion);

?>