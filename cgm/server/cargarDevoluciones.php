<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

include("conectar.php"); 
$conexion=conectar();

$sql="SELECT * FROM devoluciones order by id";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$row->id,
        'fecha'=>$row->fecha,
        'ods'=>$row->ods,
        'almacen'=>$row->almacen,
        'observaciones'=>$row->observaciones
    );
}

// $data = array(
//     'data'=>$datos
// );

echo json_encode($datos);