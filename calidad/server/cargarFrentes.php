<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

$sql="SELECT * FROM frentescal Where ods = '$ods'";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant != 0){
    while($obj = mysqli_fetch_object($exito)){
        $datos[] = array(
            'id'=>$obj->id,
            'frente'=>$obj->frente
        );
    }
}

echo json_encode($datos);