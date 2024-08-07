<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");


$query = "SELECT * FROM pruebaspcr order by nombres";
$eje = mysqli_query($conexion, $query);

$enc = mysqli_query($conexion, $query);

if($enc != 0){
    while($obj = mysqli_fetch_object($eje)){
        $datos[] = array(
            'ods' => $obj->ods,
            'doc' => $obj->doc,
            'nombres' => $obj->nombres,
            'asistencia' => $obj->asistencia,
            'motivo' => $obj->motivo,
            'resultado'=> $obj->resultado,
            'fechapcr' => $obj->fechapcr,
            'soporte' => $obj->soporte
        );
    }
}

echo json_encode($datos);