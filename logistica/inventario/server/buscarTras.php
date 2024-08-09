<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];

$sql = "SELECT * FROM traslados Where id=$id AND ods = 'LOGISTICA CENTRAL' order by fecha DESC";
$exito = mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

//busca el id si ya fue registrado en devoluciones anteriores
$query = "SELECT * FROM devherramientasp WHERE numtras = '$id'";
$eje = mysqli_query($conexion, $query);

$cont = mysqli_num_rows($eje);

$origen = $obj->origen;

$arrayods = explode(" ", $origen);
$odsorigen = $arrayods[2];

if($arrayods[0] == 'Herramientas'){
    $ubiorigen = substr($origen, 21, strlen($origen));
}else{
    $ubiorigen = substr($origen, 20, strlen($origen));
}

if($cont == 0){
    $datos = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'almacen'=>$obj->almacen,
        'ods'=>$obj->ods,
        'ubicacion'=>$obj->ubicacion,
        'items'=>$obj->items,
        'observaciones'=>$obj->observaciones,
        'origen'=>$obj->origen,
        'odsorigen'=>$odsorigen,
        'ubiorigen'=>$ubiorigen,
        'msn'=>'Ok'
    );

}else{
    $datos = array(
        'msn'=>'Error'
    );
}



echo json_encode($datos);