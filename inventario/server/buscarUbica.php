<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$alm = $_POST["alm"];

$sql="SELECT * FROM almacenes Where ods = '$ods' And almacen = '$alm'";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$row->id,
        'ods'=>$row->ods,
        'almacen'=>$row->almacen,
        'ubicacion'=>$row->ubicacion
    );
}

echo json_encode($datos);