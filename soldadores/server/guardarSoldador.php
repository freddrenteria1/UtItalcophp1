<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$nombres = $_POST["nombres"];
$doc = $_POST["doc"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];
$tipo1 = $_POST["tipo1"];
$tipo2 = $_POST["tipo2"];
$metal = $_POST["metal"];

$msn = 'Ok';

$query = "SELECT * FROM soldadores WHERE documento = $doc AND hora = ''";
$eje = mysqli_query($conexion, $query);

$cont = mysqli_num_rows($eje);

if($cont != 0){

    $sql = "UPDATE soldadores SET fecha = '$fecha', hora='$hora', proceso1 = '$tipo1', proceso2 = '$tipo2', metalurgia='$metal' WHERE documento = '$doc'";
    $exito = mysqli_query($conexion, $sql);
    
    $query = "UPDATE progsold SET cant = cant-1 WHERE fecha = '$fecha' AND hora = '$hora'";
    $eje = mysqli_query($conexion, $query);
}



if(!$exito){
    $msn = mysqli_error($conexion);
}


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);