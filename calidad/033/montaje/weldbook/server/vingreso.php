<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$clave = $_POST["clave"];

$sql="SELECT * FROM users Where email = '$user' And clave = '$clave'";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    $obj = mysqli_fetch_object($exito);
    $msn = 'Ok';
    $tipo = $obj->tipo;
}

$datos = array(
    'msn'=>$msn,
    'tipo'=>$tipo
);

echo json_encode($datos);