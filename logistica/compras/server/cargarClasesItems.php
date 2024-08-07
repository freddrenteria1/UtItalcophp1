<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM claseitems order by codtipo";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$row->id,
        'codtipo'=>$row->codtipo,
        'clase'=>$row->clase,
        'codclase'=>$row->codclase,
        'user'=>$row->user
    );
}

echo json_encode($datos);