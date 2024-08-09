<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$subcat = $_POST["subcat"];
$idcat = $_POST["idcat"];

$sql="INSERT INTO sigsubcat VALUES('', '$subcat', $idcat, '$fecha', 'JC')";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn' => 'Ok'
);

echo json_encode($datos);