<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$evaluador = $_POST["evaluador"];
$cargoeval = $_POST["cargoeval"];

$pinicial = $_POST["pinicial"];
$pfinal = $_POST["pfinal"];
$observaciones = $_POST["observaciones"];
$planes = $_POST["planes"];
$compromisos = $_POST["compromisos"];
$nombres = $_POST["nombres"];
$doc = $_POST["doc"];
$ods = $_POST["ods"];
$cargo = $_POST["cargo"];
$p1 = $_POST["p1"];
$p2 =  $_POST["p2"];
$p3 = $_POST["p3"];
$p4 = $_POST["p4"];
$p5 = $_POST["p5"];
$p6 = $_POST["p6"];
$p7 = $_POST["p7"];
$p8 = $_POST["p8"];
$p9 = $_POST["p9"];
$p10 = $_POST["p10"];
$p11 = $_POST["p11"];
$p12a = $_POST["p12a"];
$p12b = $_POST["p12b"];
$p13 = $_POST["p13"];
$p14 = $_POST["p14"];

$prom = $_POST["prom"];

//se verifica que no exista evaluación duplicada

$query = "SELECT * FROM evaluacionpersonal Where doc='$doc' AND pinicial = '$pinicial' AND pfinal = '$pfinal'";
$cons = mysqli_query($conexion, $query);

$cant = mysqli_num_rows($cons);

if($cant == 0){
    $sql="INSERT INTO evaluacionpersonal VALUES('', '$fecha', '$evaluador', '$cargoeval', '$nombres', '$doc', '$cargo', '$ods', '$pinicial', '$pfinal', $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10, $p11, $p12a, $p12b, $p13, $p14, $prom, '$observaciones', '$compromisos', '$planes')";
    $exito=mysqli_query($conexion, $sql);
}


$datos = array(
    'msn' => 'Ok'
);

echo json_encode($datos);