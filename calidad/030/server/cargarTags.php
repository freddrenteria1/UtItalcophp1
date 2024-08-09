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

$sql="SELECT * FROM tags WHERE ods='$ods' AND esp = '$esp' AND fequipo = '$equipo'  order by tag";
$exito=mysqli_query($conexion, $sql);


while($obj = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$obj->id,
        'tag'=>$obj->tag,
        'rca'=>$obj->rca
    );
}

echo json_encode($datos);