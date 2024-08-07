<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$doc = $_POST["doc"];
$ods = $_POST["ods"];

$query = "SELECT * FROM trabajadores WHERE cedula = $doc AND estado = 'Activo'";
$eje = mysqli_query($conexion, $query);

$enc = mysqli_query($conexion, $query);

if($enc != 0){
    while($obj = mysqli_fetch_object($eje)){
        $datos[] = array(
            'doc' => $obj->cedula,
            'nombres' => $obj->nombres . ' ' . $obj->apellidos,
            'ods'=>$ods
        );
    }
}

echo json_encode($datos);