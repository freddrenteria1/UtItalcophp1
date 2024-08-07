<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$almacen = $_POST["alm"];
$ubicacion = $_POST["ubicacion"];

$alm = 'AC'.$ods.$ubicacion;

$sql = "SELECT * FROM inventario Where ubicacion='$alm' order by articulo";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    if($obj->codtipo != '03' && $obj->clase != 'SERVICIO DE ALQUILER'){

        $datos[] = array(
            'id'=>$obj->id,
            'codigo'=>$obj->codigo,
            'unidad'=>$obj->unidad,
            'cantidad'=>$obj->cantidad,
            'articulo'=>$obj->articulo
        );
    }
}

echo json_encode($datos);