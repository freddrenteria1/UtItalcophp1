<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$id = $_POST["id"];
$fotos = $_POST["fotos"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="UPDATE aseguramientos SET soportes = '$fotos' WHERE id = $id";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Realizado';
}

$datos[] = array(
    'msn' => $msn
);

echo json_encode($datos);