<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM adminlog order by nombres";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$row->id,
        'fecha'=>$row->fecha,
        'nombres'=>$row->nombres,
        'clave'=>$row->clave,
        'nivel'=>$row->nivel
    );
}

echo json_encode($datos);