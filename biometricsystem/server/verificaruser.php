<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$email = $_POST["user"];
$clave = $_POST["clave"];

$query = "SELECT * FROM userbio Where email='$email' And clave='$clave'";
$eje = mysqli_query($conexion, $query);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    $obj = mysqli_fetch_object($eje);
    $datos = array(
        'ods'=>$obj->ods,
        'numods'=>$obj->numods,
        'voboitalco'=>$obj->voboitalco,
        'voboecp'=>$obj->voboecp,
        'privilegio'=>$obj->privilegio,
        'msn'=>'Ok'
    );
}else{
    $datos = array(
        'ods'=>'',
        'numods'=>'',
        'msn'=>'Error'
    );
}

echo json_encode($datos);