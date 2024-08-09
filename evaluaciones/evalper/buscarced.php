<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$ced = $_POST["ced"];


$sql="SELECT * FROM trabajadores WHERE cedula = '$ced'";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){
    $row = mysqli_fetch_object($exito);
    $nombres = $row->nombres . ' ' . $row->apellidos;
    $cargo = $row->cargo;
    $ods = $row->ods;
    $msn = 'Ok';
}else{
    $nombres = '';
    $ods = '';
    $cargo = '';
    $msn = 'Error';
}

$datos = array(
    'nombres'=>$nombres,
    'ods'=>$ods,
    'cargo'=>$cargo,
    'msn' => $msn
);

echo json_encode($datos);