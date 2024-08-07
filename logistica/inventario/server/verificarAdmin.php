<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$clave = $_POST["clave"];

$sql="SELECT * FROM adminlog Where clave = '$clave'";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $nivel = 0;
}else{
    $row = mysqli_fetch_object($exito);
    $msn = 'Ok';
    $nivel = $row->nivel;
}

$datos = array(
    'msn'=>$msn,
    'nivel'=>$nivel
);

echo json_encode($datos);