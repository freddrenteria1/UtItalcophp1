<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql = "SELECT * FROM inventario Where ubicacion='AP' order by articulo";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$obj->id,
        'codigo'=>$obj->codigo,
        'unidad'=>$obj->unidad,
        'cantidad'=>$obj->cantidad,
        'articulo'=>$obj->articulo
    );
}

echo json_encode($datos);