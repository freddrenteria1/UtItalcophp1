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

$sql = "SELECT * FROM docprov WHERE user = '$user'";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    $obj = mysqli_fetch_object($eje);

    $datos = array(
        'file1' => $obj->file1,
        'file2' => $obj->file2,
        'file3' => $obj->file3,
        'file4' => $obj->file4,
        'file5' => $obj->file5,
        'file6' => $obj->file6
    );

}

echo json_encode($datos);