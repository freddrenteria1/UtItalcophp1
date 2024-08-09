<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$id = $_POST["id"];
$user = $_POST["user"];
$clave = $_POST["clave"];
$catSel = $_POST["catSel"];

$sql="INSERT INTO siguser VALUES('', '$fecha', '$user', '$clave', 'Activo', '$catSel')";
$exito=mysqli_query($conexion, $sql);

$msn = 'Ok';

$datos = array(
    'msn' => $msn
);

echo json_encode($datos);