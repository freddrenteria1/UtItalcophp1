<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ccontrol = $_POST["ccontrol"];
$fecha = $_POST["fecha"];

$query = "SELECT * FROM notas WHERE cuadro = '$ccontrol' AND fecha = '$fecha'";
$eje = mysqli_query($conexion, $query);

$cont = mysqli_num_rows($eje);

if($cont != 0){
     $obj = mysqli_fetch_object($eje);

     $datos = array(
        'nota'=>$obj->nota
     );
} 
 

echo json_encode($datos);