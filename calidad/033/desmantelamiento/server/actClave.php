<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$claveact = $_POST["claveact"];
$claven = $_POST["claven"];

$sql="SELECT * FROM users Where email = '$user' And clave = '$claveact'";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Clave actual incorrecta...';
    $tipo = '';
}else{
    $query = "UPDATE users SET clave = '$claven' WHERE email = '$user'";
    $act = mysqli_query($conexion, $query);
    $msn = 'Ok';
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);