<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$avanceprog = $_POST["avanceprog"];
$avanceeje = $_POST["avanceeje"];
$avancedesv = $_POST["avancedesv"];

$msn = 'Ok';

$sql="UPDATE info SET avanceprog = '$avanceprog', avanceeje = '$avanceeje', avancedesv = '$avancedesv' WHERE id=1";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);