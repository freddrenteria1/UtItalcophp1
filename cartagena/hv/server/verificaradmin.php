<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$userhv = $_POST["userhv"];
$cont = $_POST["cont"];

$sql="SELECT * FROM usuarios Where usuario = '$userhv' AND clave = '$cont'";
$exito=mysqli_query($conexion, $sql);
$enc = mysqli_num_rows($exito);

if($enc != 0){
    $msn = 'Ok;';
}else{
    $msn = 'Error';
}

$datos = array(
    'msn'=>$msn
);
 

echo json_encode($datos);