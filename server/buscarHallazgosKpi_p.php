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

$ods = substr($ods, 4);

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="SELECT * FROM hallazgos WHERE ods like '%$ods%' AND fecha<='$fecha'";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $datos[] = array(
        'id' => $row->id,
        'item' => $row->item,
        'fecha'=>$row->fecha,
        'detalles'=>$row->detalles,
        'reporta'=>$row->reporta,
        'criticidad'=>$row->criticidad,
        'tipificacion'=>$row->tipificacion,
        'plan'=>$row->plan,
        'fcierre'=>$row->fcierre,
        'estado'=>$row->estado,
        'ods'=>$row->ods
    );

} 
echo json_encode($datos);