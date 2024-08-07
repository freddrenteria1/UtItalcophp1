<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$user = $_POST["usuario"];
$clave = $_POST["clave"];

$ip = $_SERVER['REMOTE_ADDR'];

$sql="SELECT * FROM usersinsp WHERE cedula = '$user' AND clave = '$clave'";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){
    $row = mysqli_fetch_object($exito);
    $numods = $row->ods;
    $nombres = $row->nombres;
    $cargo = $row->cargo;
    $cedula = $row->cedula;
    $codigo = $row->codigo;
    $msn = 'OK';
}else{
    $numods = '';
    $nombres = '';
    $cargo = '';
    $cedula = '';
    $codigo = '';
    $msn = 'ERROR';
}

$datos = array(
    'numods'=>$numods,
    'nombres'=>$nombres,
    'cargo'=>$cargo,
    'cedula'=>$cedula,
    'codigo'=>$codigo,
    'msn' => $msn
);

echo json_encode($datos);