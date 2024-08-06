<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$finicio = $_POST["finicio"];
$ffinal = $_POST["ffinal"];
$ods = $_POST["ods"];

if($ods == 'Todo'){
    $query = "SELECT * FROM alimentacion WHERE fecha BETWEEN '$finicio' AND '$ffinal'";
    $eje = mysqli_query($conexion, $query);
}else{
    $query = "SELECT * FROM alimentacion WHERE ods='$ods' AND fecha BETWEEN '$finicio' AND '$ffinal'";
    $eje = mysqli_query($conexion, $query);
}

while($obj = mysqli_fetch_object($eje)){
    $datos[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'servicio'=>$obj->servicio,
        'casino'=>$obj->casino,
        'ods'=>$obj->ods,
        'solicitado'=>$obj->solicitado,
        'sistema'=>$obj->sistema,
        'manual'=>$obj->manual,
        'adicionales'=>$obj->adicionales,
        'sobrantes'=>$obj->sobrantes,
        'total'=>$obj->total
    );
}
 
echo json_encode($datos);