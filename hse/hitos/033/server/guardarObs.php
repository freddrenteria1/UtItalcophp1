<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];
$observacion = $_POST["observacion"];

// $sql="SELECT * FROM hitoshse WHERE id=$id";
// $exito=mysqli_query($conexion, $sql);

// $obj = mysqli_fetch_object($exito);

// if($obj->observaciones != ""){
//     $obs = json_decode($obj->observaciones);
// }

// $obs[] = array(
//     'obs'=>$observacion
// );

// $obs = json_encode($obs);

$query = "UPDATE hitoshse SET observaciones = '$observacion' WHERE id=$id";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    $ok = false;
}else{
    $ok = true;
}

$datos = array(
    'ok'=>$ok
);

echo json_encode($datos);