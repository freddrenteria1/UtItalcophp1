<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$user = $_POST["user"];
$clave = $_POST["clave"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="SELECT * FROM userspermisos WHERE email = '$user' AND clave = '$clave'";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){
    $row = mysqli_fetch_object($exito);
    $numods = $row->numods;
    $ods = $row->ods;
    $msn = 'OK';
}else{
    $numods = '';
    $ods = '';
    $msn = 'ERROR';
}

$datos = array(
    'numods'=>$numods,
    'ods'=>$ods,
    'msn' => $msn
);

echo json_encode($datos);