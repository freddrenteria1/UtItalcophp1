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

$sql="SELECT * FROM siguser WHERE user = '$user' AND clave = '$clave'";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){
    $row = mysqli_fetch_object($exito);
    $estado = $row->estado;
    $categorias = $row->categorias;

    $msn = 'OK';
}else{
    $estado = '';
    $categorias = '';
    $msn = 'ERROR';
}

$datos = array(
    'estado'=>$estado,
    'categorias'=>$categorias,
    'msn' => $msn
);

echo json_encode($datos);