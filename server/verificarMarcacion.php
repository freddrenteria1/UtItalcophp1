<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$finicio = $_POST["finicio"];

$sql = "SELECT * FROM marcaciones WHERE finicio='$finicio'";
$exito = mysqli_query($conexion, $sql);
$cant = mysqli_num_rows($exito);

if($cant != 0){
    $msn = 'Existe';
}else{
    $msn = 'Ok';
}

$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);