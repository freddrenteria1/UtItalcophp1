<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

// $ods = '015';
// $fecha = '31/03/2021';

$fechai = $_POST["fechai"];
$fechaf = $_POST["fechaf"];
$ods = $_POST["ods"];

$sql="SELECT * FROM galeria WHERE ods='$ods' AND (fecha between '$fechai' AND '$fechaf') ";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){

    $datos[] = array(
        'id' => $row->id,
        'seccion' => $row->seccion,  
        'detalles' => $row->detalles,  
        'foto' => $row->foto
    );

}

echo json_encode($datos);