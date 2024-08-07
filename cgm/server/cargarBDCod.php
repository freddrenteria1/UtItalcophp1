<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

include("conectar.php"); 
$conexion=conectar();

$sql="SELECT * FROM materiales order by id";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$row->id,
        'cm'=>$row->cm,
        'descripcion'=>$row->descripcion,
        'unidad'=>$row->unidad,
        'localizacion'=>$row->localizacion,
        'clase'=>$row->clase,
        'tipo'=>$row->tipo,
        'precio'=>$row->precio

    );
}

// $data = array(
//     'data'=>$datos
// );

echo json_encode($datos);