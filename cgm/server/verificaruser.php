<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

include("conectar.php"); 
$conexion=conectar();

$user = $_POST["usermat"];
$clave = $_POST["clavemat"];

$sql="SELECT * FROM users WHERE usuario = '$user' AND clave = '$clave'";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont != 0){
    $row = mysqli_fetch_object($exito);

    $datos = array(
        'tipo'=>$row->tipo,
        'estado'=>$row->estado,
        'msn'=>'Ok'
    );
}else{
    $datos = array(
        'tipo'=>'',
        'estado'=>'',
        'msn'=>'Error'
    );
}


echo json_encode($datos);