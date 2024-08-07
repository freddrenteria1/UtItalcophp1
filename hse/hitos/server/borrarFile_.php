<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_GET["id"];
$archivo = $_GET["archivo"];


$sql="SELECT * FROM hitoshse WHERE id=$id";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

if($obj->doc != ""){
    $docs = json_decode($obj->doc);
}

echo json_encode($docs);

$cant = count($docs);

for($i=0; $i<$cant; $i++){
    if($docs[$i]->doc == $archivo){
        unset($docs[$i]);
    }
}

//$docs = json_encode($docs);

// $query = "UPDATE hitoshse SET doc = '$docs' WHERE id=$id";
// $eje = mysqli_query($conexion, $query);

// if(!$eje){
//     $ok = false;
// }else{
//     $ok = true;
// }

$datos = array(
    'ok'=>$ok

);

