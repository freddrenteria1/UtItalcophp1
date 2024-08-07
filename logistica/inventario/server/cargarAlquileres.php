<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$query = "SELECT codigo, unidad, id, articulo, SUM(cantidad) as tot FROM inventario Where clase = 'SERVICIO DE ALQUILER' group by codigo";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $datos[] = array(
        'id'=>$obj->id,
        'codigo'=>$obj->codigo,
        'unidad'=>$obj->unidad,
        'cantidad'=>$obj->tot,
        'articulo'=>$obj->articulo
    );

}

echo json_encode($datos);