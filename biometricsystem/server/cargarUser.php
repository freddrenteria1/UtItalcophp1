<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");


$query = "SELECT * From userbio order by nombres";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){
    $datos[] = array(
        'id'=>$obj->id,
        'nombres'=>$obj->nombres,
        'email'=>$obj->email,
        'clave'=>$obj->clave,
        'ods'=>$obj->ods,
        'numods'=>$obj->numods,
        'voboitalco'=>$obj->voboitalco,
        'voboecp'=>$obj->voboecp,
        'msn'=>'Ok'
    );
}

echo json_encode($datos);