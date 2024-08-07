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

$sql = "SELECT * FROM anexoa WHERE user = '$user'";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    $obj = mysqli_fetch_object($eje);

    $datos = array(
        's1' => $obj->s1,
        's2' => $obj->s2,
        's3' => $obj->s3,
        's4' => $obj->s4,
        's5' => $obj->s5,
        's6' => $obj->s6,
        'l1' => $obj->l1,
        'l2' => $obj->l2,
        'l3' => $obj->l3,
        'archivo'=>$obj->archivo
    );

}

echo json_encode($datos);