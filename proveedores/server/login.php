<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$email = $_POST["email"];
$clave = $_POST["clave"];

//GUARDA LA ENTRADA
$msn = 'Ok';

$sql = "SELECT * FROM usuariosprov WHERE email = '$email' AND clave='$clave'";
$eje = mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($eje);

if($enc == 0){
    $msn = 'Usuario no existe... comprueba el email y contraseña... ';
    $empresa = '';
}else{
    $obj = mysqli_fetch_object($eje);
    $empresa = $obj->empresa;
}

$datos = array(
    'msn'=>$msn,
    'emp'=>$empresa
);

echo json_encode($datos);