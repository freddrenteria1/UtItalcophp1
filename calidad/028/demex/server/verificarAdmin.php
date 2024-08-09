<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$clave = $_POST["clave"];

$sql="SELECT * FROM admincalidad Where clave = '$clave'";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $nivel = 0;
    $user = '';
}else{
    $row = mysqli_fetch_object($exito);
    $msn = 'Ok';
    $nivel = $row->nivel;
    $user = $row->nombres;
}

$datos = array(
    'msn'=>$msn,
    'nivel'=>$nivel,
    'user'=>$user
);

echo json_encode($datos);