<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$ods = $_POST["ods"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="SELECT * FROM conversatorios WHERE ods = '$ods'";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $datos[] = array(
        'id' => $row->id,
        'fecha'=>$row->fecha,
        'tema'=>$row->tema,
        'resp'=>$row->resp,
        'ods'=>$row->ods
    );

}  

echo json_encode($datos);