<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM usuarioslogistica order by nombres";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$row->id,
        'nombres'=>$row->nombres,
        'email'=>$row->email,
        'clave'=>$row->clave,
        'ultimo_ingreso'=>$row->ultimo_ingreso,
        'ip'=>$row->ip,
        'numods'=>$row->ods,
        'almacen'=>$row->almacen,
        'estado' => $row->estado
    );
}

echo json_encode($datos);