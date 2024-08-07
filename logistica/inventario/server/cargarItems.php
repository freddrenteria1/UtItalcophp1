<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$tipo = $_POST["tipo"];

$sql="SELECT * FROM items order by articulo";
$exito=mysqli_query($conexion, $sql);


while($row = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$row->id,
        'tipo'=>$row->tipo,
        'codtipo'=>$row->codtipo,
        'clase'=>$row->clase,
        'codclase'=>$row->codclase,
        'item'=>$row->articulo,
        'codigo'=>$row->codigo,
        'unidad'=>$row->unidad
    );
}

echo json_encode($datos);