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

$sql = "SELECT * FROM infofinanciera WHERE user = '$user'";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    $obj = mysqli_fetch_object($eje);

    $datos = array(
        'activoscorr' => $obj->activoscorr,
        'activosnocorr' => $obj->activosnocorr,
        'pasivocorr' => $obj->pasivocorr,
        'pasivonocorr' => $obj->pasivonocorr,
        'patrimonio' => $obj->patrimonio,
        'ingresos' => $obj->ingresos,
        'gastos' => $obj->gastos,
        'costos' => $obj->costos,
        'utilidad' => $obj->utilidad
    );

}

echo json_encode($datos);