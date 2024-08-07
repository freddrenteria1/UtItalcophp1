<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

include("conectar.php"); 
$conexion=conectar();

$sql="SELECT * FROM devoluciones";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

$num = $cont+1;

$datos = array(
    'num'=>$num
);


echo json_encode($datos);