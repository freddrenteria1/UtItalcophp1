<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$ods = $_POST["ods"];
$lugar = $_POST["lugar"];
$turno = $_POST["turno"];
$nombres = $_POST["nombres"];
$cargo = $_POST["cargo"];
$doc = $_POST["doc"];
$edad = $_POST["edad"];
$enf = $_POST["enf"];
$municasos = $_POST["municasos"];
$familiar = $_POST["familiar"];
$sintomas = $_POST["sintomas"];
$sintomascuales = $_POST["sintomascuales"];
$tapabocas = $_POST["tapabocas"];

$covidpos = $_POST["covidpos"];
$vaccodiv = $_POST["vaccodiv"];
$dosisvac = $_POST["dosisvac"];
$motivo = $_POST["motivo"];

$pconfpos = $_POST["pconfpos"];

$fingreso = $_POST["fingreso"];

if($lugar == 'ETILENO' OR $lugar == 'TURBOEXPANDER' OR $lugar == 'BODEGA MATERIALES' OR $lugar == 'BALANCE' OR $lugar == 'CENTRAL DEL NORTE'){
    $frente = 'GRB';
}else{
    $frente = 'FGRB';
}

$msn = 'Realizado...';

$sql="INSERT INTO testcovid VALUES('','$fecha', '$fingreso', '$ods','$lugar','$frente','$turno','$nombres','$cargo','$doc',$edad,'$enf','$municasos','$familiar','$sintomas','$sintomascuales','$tapabocas','$covidpos','$vaccodiv','$dosisvac','$motivo','$pconfpos')";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $msn = mysqli_error($conexion);
}


$datos = array(
    'msn' => $msn
);

echo json_encode($datos);