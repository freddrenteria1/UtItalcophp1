<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$hito = 'INTERCAMBIADOR';

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="SELECT tag FROM activities WHERE familia = '$hito' GROUP BY tag";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $datos[] = array(
        'tag' => $row->tag
    );

}  
echo json_encode($datos);