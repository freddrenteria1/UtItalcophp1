<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$etipo = $_POST["etipo"];
$servicio = $_POST["servicio"];
$numtubos = $_POST["numtubos"];
$dimtubo = $_POST["dimtubo"];
$caltubo = $_POST["caltubo"];
$mattubo = $_POST["mattubo"];

$msn = 'Ok';

$sql = "UPDATE os38 SET etipo = '$etipo', servicio='$servicio', num_tubos = '$numtubos', dimen_tubos = '$dimtubo',  calibre = '$caltubo', material_tubos = '$mattubo' WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);