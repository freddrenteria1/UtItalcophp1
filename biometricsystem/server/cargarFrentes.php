<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$ods = $_POST["ods"];

if($ods != "0"){
    $query = "SELECT * FROM frentestrab Where ods='$ods' order by frentetrab";
    $eje = mysqli_query($conexion, $query);
}else{
    $query = "SELECT * FROM frentestrab";
    $eje = mysqli_query($conexion, $query);
}



while($row = mysqli_fetch_object($eje)){
    $datos[] = array(
        'id'=> $row->id,
        'frentetrab' => $row->frentetrab,
        'liderecp' => $row->liderecp
    );
}

echo json_encode($datos);