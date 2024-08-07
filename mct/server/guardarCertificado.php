<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$doc = $_POST["doc"];
$nombres = $_POST["nombres"];
$resp = $_POST["resp"];
$puntaje = $_POST["puntaje"];


$query = "UPDATE mct SET fecha ='$fecha', respuestas='$resp', puntaje=$puntaje WHERE documento = '$doc'";
$eje = mysqli_query($conexion, $query);

if($puntaje == 100){
    $estado='SI';
}else{
    $estado='NO';
    $puntaje = 0;
}


$datos = array(
    'cedula'=>$doc,
    'nombres'=>$nombres,
    'estado'=>$estado,
    'puntaje'=>$puntaje,
    'fecha'=>$fecha,
    'msn'=>'Ok'
);


echo json_encode($datos);

?>