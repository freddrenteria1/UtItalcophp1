<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$doc = $_POST["doc"];
$ods = $_POST["ods"];

$query = "SELECT * FROM userbitacora WHERE doc = $doc";
$eje = mysqli_query($conexion, $query);

$enc = mysqli_query($conexion, $query);

if($enc != 0){
    while($obj = mysqli_fetch_object($eje)){
        $datos[] = array(
            'doc' => $obj->doc,
            'nombres' => $obj->nombres,
            'ods'=>$ods
        );
    }
}

echo json_encode($datos);