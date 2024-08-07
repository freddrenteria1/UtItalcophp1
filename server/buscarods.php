<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$ods = $_POST["ods"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="SELECT * FROM users WHERE numods = '$ods'";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){
    $row = mysqli_fetch_object($exito);
    $ods = $row->ods;
    $fase = $row->fase;
    $odsant = $row->odsant;
    $msn = 'OK';
}else{
    $ods = '';
    $msn = 'ERROR';
}

$datos = array(
    'ods'=>$ods,
    'msn' => $msn,
    'fase' => $fase,
    'odsant' => $odsant
);

echo json_encode($datos);