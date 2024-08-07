<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d h:m:s");

$fecha = $_POST["fecha"];



$msn = 'Realizado...';

$sql = "SELECT * FROM notas WHERE fecha='$fecha'";
$ejeb = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($ejeb)){
    $datos[] = array(
        'cuadro'=>$obj->cuadro,
        'nota'=>$obj->nota
    );
}

 
 
echo json_encode($datos);