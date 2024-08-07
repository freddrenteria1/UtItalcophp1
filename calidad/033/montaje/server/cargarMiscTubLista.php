<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

$sql="SELECT * FROM osMiscTub WHERE ods='$ods'  GROUP BY isometrico";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $datos[]= array(
        'id'=>$obj->id,
        'lazo'=>$obj->lazo,
        'tag'=>$obj->isometrico
    );

}

echo json_encode($datos);