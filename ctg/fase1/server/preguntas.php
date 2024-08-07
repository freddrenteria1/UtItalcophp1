<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");


$query = "SELECT * FROM pregfases order by num";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $datos[] = array(
        'num'=>$obj->num,
        'pregunta'=>$obj->pregunta,
        'respuestas'=>$obj->respuestas,
        'correcta'=>$obj->correcta
    );

}


echo json_encode($datos);