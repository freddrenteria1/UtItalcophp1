<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$msn = 'Ok';

$sql = "SELECT * FROM anexob WHERE user = '$user' order by item";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    
    while($obj = mysqli_fetch_object($eje)){
        $datos[] = array(
            'item' => $obj->item,
            'estado' => $obj->estado,
            'obs' => $obj->observacion,
            'archivo' => $obj->archivo
        );
    }
}

echo json_encode($datos);