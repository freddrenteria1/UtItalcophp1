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

$alm = 'AH'.$ods.$ubicacion;

$query = "SELECT * FROM invplanta Where ubicacion='$ubicacion' And ods = '$ods' And almacen = 'Herramientas' and cant > 0 Order by ced";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $datos[] = array(
        'id'=>$obj->id,
        'ced'=>$obj->ced,
        'nombres'=>$obj->nombres,
        'cod'=>$obj->codigo,
        'articulo'=>$obj->articulo,
        'cant'=>$obj->cant
    );

}

echo json_encode($datos);