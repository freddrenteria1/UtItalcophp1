<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];
$ods = $_POST["ods"];


$msn = 'Ok';

  

    $query2 = "UPDATE invactivos SET ods = '$ods' Where id = $id";
    $realizar = mysqli_query($conexion, $query2);
    
    
 
$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);