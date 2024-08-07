<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ip = $_SERVER['REMOTE_ADDR'];
 
$ced = $_POST["ced"];

$sql="SELECT * FROM rda Where cedsol = '$ced'";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'ods'=>$obj->ods,
        'items'=>$obj->items,
        'fecharev'=>$obj->fecharev,
        'fechaaprob'=>$obj->fechaaprob,
        'estado'=>$obj->estado
    );
}

echo json_encode($datos);