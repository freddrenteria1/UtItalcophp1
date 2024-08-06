<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$esp = $_POST["esp"];
$equipo = $_POST["equipo"];
$alcance = $_POST["alcance"];

$sql="SELECT * FROM os114 WHERE ods='$ods' order by lazo_corrosion";
$exito=mysqli_query($conexion, $sql);


while($obj = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$obj->id,
        'lazo_corrosion'=>$obj->lazo_corrosion,
        'isometrico'=>$obj->isometrico,
        'cmls'=>$obj->cml_inspeccionados
    );
}

echo json_encode($datos);