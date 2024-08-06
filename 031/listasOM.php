<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$semana = $_POST["semana"];



$sql="SELECT *, COUNT(*) as cantom FROM ordenmant WHERE semana = '$semana' GROUP BY frente, semana";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $om[] = array(
        'id'=>$obj->id,
        'frente'=>$obj->frente,
        'semana'=>$obj->semana,
        'cantom'=>$obj->cantom
    );

}




echo json_encode($om);