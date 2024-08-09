<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM prov order by proveedor";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $datos[] = array(
        'id'=>$obj->id,
        'proveedor'=>$obj->proveedor
    );
    
}

echo json_encode($datos);