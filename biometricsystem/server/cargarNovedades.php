<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$ods = $_POST["ods"];

$query = "SELECT * FROM novepersonal Where ods='$ods'";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){
    $datos[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'codigo'=>$obj->codigo,
        'doc'=>$obj->doc,
        'nombres'=>$obj->nombres,
        'cargo'=>$obj->cargo,
        'grupo'=>$obj->grupo,
        'novedad'=>$obj->novedad
    );
}

echo json_encode($datos);