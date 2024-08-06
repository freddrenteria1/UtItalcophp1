<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$ods=$_POST["ods"];
$grupo = $_POST["grupo"];

$query = "SELECT * FROM trabajadores Where frente='$grupo' And ods='$ods' order by nombres";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){
    $datos[] = array(
        'id'=>$obj->id,
        'contrato'=>$obj->contrato,
        'cedula'=>$obj->cedula,
        'nombres'=>$obj->nombres . ' ' . $obj->apellidos
    );
}

echo json_encode($datos);