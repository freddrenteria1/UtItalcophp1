<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

// $ods = '015';
// $fecha = '31/03/2021';

//$hito = $_POST["hito"];
$ods = $_POST["ods"];
$fecha = $_POST["fecha"];

$sql="SELECT * FROM hcap WHERE ods='$ods'";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
    $datos[] = array(
        'fase' => $row->fase,
        'personal' => $row->personal,
        'horas' => $row->horas,
    );
}

echo json_encode($datos);