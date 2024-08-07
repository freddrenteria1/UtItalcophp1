<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$msn = 'Ok';

$sql = "SELECT * FROM infoexperiencia WHERE user = '$user'";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    $obj = mysqli_fetch_object($eje);

    $datos = array(
        'cliente1' => $obj->cliente1,
        'contratoc1' => $obj->contratoc1,
        'plazoc1' => $obj->plazoc1,
        'finicioc1' => $obj->finicioc1,
        'ffinc1' => $obj->ffinc1,
        'valorc1' => $obj->valorc1,
        'cliente2' => $obj->cliente2,
        'contratoc2' => $obj->contratoc2,
        'plazoc2' => $obj->plazoc2,
        'finicioc2' => $obj->finicioc2,
        'ffinc2' => $obj->ffinc2,
        'valorc2' => $obj->valorc2,
        'cliente3' => $obj->cliente3,
        'contratoc3' => $obj->contratoc3,
        'plazoc3' => $obj->plazoc3,
        'finicioc3' => $obj->finicioc3,
        'ffinc3' => $obj->ffinc3,
        'valorc3' => $obj->valorc3
    );

}

echo json_encode($datos);