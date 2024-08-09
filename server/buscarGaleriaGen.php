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

$sql="SELECT * FROM galeria WHERE ods like '%$ods%' AND fecha = '$fecha'";
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