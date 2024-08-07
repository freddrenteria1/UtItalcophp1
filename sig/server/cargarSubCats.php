<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

// $ip = $_SERVER['REMOTE_ADDR'];
$cons = "SELECT * FROM sigcat";
$eje = mysqli_query($conexion, $cons);

$cont = mysqli_num_rows($eje);

if($cont > 0 ){

    while($row = mysqli_fetch_object($eje)){

        $cate[] = array(
            'idcat'=>$row->id,
            'categoria'=>$row->categoria
        );
    }

}

echo json_encode($cate);