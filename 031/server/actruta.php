<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$rutaprog = $_POST["rutaprog"];
$rutaeje = $_POST["rutaeje"];
$rutadesv = $_POST["rutadesv"];

$msn = 'Ok';

$sql="UPDATE info SET rutaprog = '$rutaprog', rutaeje = '$rutaeje', rutadesv = '$rutadesv' WHERE id=1";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);