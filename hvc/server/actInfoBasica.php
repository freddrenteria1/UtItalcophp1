<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$tipodoc = $_POST["tipodoc"];
$doc = $_POST["doc"];
$email = $_POST["email"];
$nombres = $_POST["nombres"];
$fnac = $_POST["fnac"];
$tel = $_POST["tel"];
$dir = $_POST["dir"];

$arrayDataInfop = $_POST["arrayDataInfop"];
$arrayDataContacto = $_POST["arrayDataContacto"];
$arrayDataPerfil = $_POST["arrayDataPerfil"];

$query = "UPDATE registro SET email = '$email', nombres = '$nombres', nacimiento = '$fnac', tel = '$tel' WHERE doc = '$doc'";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    $ok = false;
}else{
    $ok = true;
}

$sql = "UPDATE infobasica SET email = '$email', datospersonales = '$arrayDataInfop', datoscontacto = '$arrayDataContacto', domicilio = '$dir', perfil = '$arrayDataPerfil' WHERE doc = '$doc'";
$exito = mysqli_query($conexion, $sql);

$datos = array(
    'ok'=>$ok
);

echo json_encode($datos);